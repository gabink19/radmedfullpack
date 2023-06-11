<?php

namespace App\Helpers;

use App\Core\Database;
use App\Helpers\AdminApiHelper;
use App\Helpers\CoreHelper;
use App\Helpers\FileHelper;
use App\Helpers\LogHelper;
use App\Helpers\UserHelper;
use App\Helpers\FileServerContainerHelper;
use App\Models\File;
use App\Models\FileAction;

/**
 * main file action class
 */
class FileActionHelper
{
    public $errorMsg = null;

    /**
     * Queue file to be deleted.
     * 
     * @param integer $serverId
     * @param integer $fileId
     * @param string $filePath
     * @param string $actionDate
     * @return boolean|\DBObject
     */
    static function queueDeleteFile($serverId, $filePath = '', $fileId = null, $actionDate = null, $isUploadedFile = false) {
        // if no action date passed, assume it needs done straight away
        if ($actionDate == null) {
            $actionDate = CoreHelper::sqlDateTime();
        }

        // create our FileAction object
        $fileAction = FileAction::create();
        $fileAction->file_id = $fileId;
        $fileAction->server_id = $serverId;
        $fileAction->file_path = $filePath;
        $fileAction->is_uploaded_file = (int) $isUploadedFile;
        $fileAction->file_action = 'delete';
        $fileAction->status = 'pending';
        $fileAction->date_created = CoreHelper::sqlDateTime();
        $fileAction->action_date = $actionDate;
        $fileAction->save();

        return $fileAction;
    }

    static function processQueue($limitType = null, $limitActions = 100) {
        // get file servers
        $fileServers = FileHelper::getFileServerData();
        $db = Database::getDatabase();

        // setup server ids, we need this to be an array to allow for multiple drives on the same server
        $server = FileHelper::getCurrentServerDetails();
        $serverIds = array();
        if ($server['serverType'] == 'local') {
            // load other non direct servers
            $servers = $db->getRows('SELECT id '
                    . 'FROM file_server '
                    . 'WHERE serverType != \'direct\'');
            foreach ($servers AS $serverItem) {
                $serverIds[] = (int) $serverItem['id'];
            }
        }
        else {
            $serverIds[] = (int) $server['id'];
        }

        // load pending queue items
        $pendingItems = $db->getRows('SELECT file_action.id, file_action.action_data, '
                . 'file_action.file_path, file_action.file_action, file_action.file_id, '
                . 'file.localFilePath, file.fileHash, file.serverId, file_action.is_uploaded_file '
                . 'FROM file_action '
                . 'LEFT JOIN file ON file_action.file_id = file.id '
                . 'WHERE file_action.server_id IN (' . implode(',', $serverIds) . ') '
                . 'AND file_action.status = \'pending\' '
                . 'AND file_action.action_date < NOW() '
                . '' . ($limitType != null ? ('AND file_action.file_action = ' . $db->quote($limitType)) : '') . ' '
                . 'ORDER BY file_action.id ASC '
                . 'LIMIT ' . $limitActions);
        if ($pendingItems) {
            // get an admin API details for remote calls
            $apiCredentials = UserHelper::getAdminApiDetails();
            if ($apiCredentials === false) {
                // log
                LogHelper::error('Failed getting any admin API credentials.');
                LogHelper::setContext($oldContext);

                return false;
            }

            foreach ($pendingItems AS $pendingItem) {
                // reload item to make sure it's not been triggered by another instance of this script running and it's still pending
                $checkPending = $db->getValue('SELECT id '
                        . 'FROM file_action '
                        . 'WHERE id=' . (int) $pendingItem['id'] . ' '
                        . 'AND status=\'pending\' '
                        . 'LIMIT 1');
                if (!$checkPending) {
                    continue;
                }

                // prepare file path
                $filePath = trim($pendingItem['file_path']);
                if ((int) $pendingItem['is_uploaded_file'] === 1) {
                    // this is the original file (i.e. not a cache file or preview image) 
                    // load file object and get full path. This is may only be
                    // available on the file server itself hence the queue may
                    // no know about it.
                    $file = File::loadOneById($pendingItem['file_id']);
                    if ($file) {
                        // get full path to the file
                        $pendingItem['file_path'] = $file->getFullFilePath();

                        // update the file_action item with the correct path
                        $db->query('UPDATE file_action '
                                . 'SET file_path = :file_path '
                                . 'WHERE id = ' . (int) $pendingItem['id'] . ' '
                                . 'LIMIT 1', array(
                            'file_path' => $pendingItem['file_path'],
                        ));
                    }
                }

                // validation
                if (strlen($filePath) <= 1) {
                    $db->query('UPDATE file_action '
                            . 'SET status = \'failed\', '
                            . 'status_msg=\'File has zero length or is in the root folder.\', '
                            . 'last_updated=NOW() '
                            . 'WHERE id = ' . (int) $pendingItem['id'] . ' '
                            . 'LIMIT 1');
                    continue;
                }

                // set processing
                $db->query('UPDATE file_action '
                        . 'SET status = \'processing\', '
                        . 'last_updated=NOW() '
                        . 'WHERE id = ' . (int) $pendingItem['id'] . ' '
                        . 'LIMIT 1');

                // do action
                switch ($pendingItem['file_action']) {
                    case 'delete':
                        // reload the correct server, this is needed if this script is processing multiple
                        // flysystem, ftp or local actions.
                        $server = FileHelper::loadServerDetails($pendingItem['serverId']);

                        // handle the actual removal of the file
                        $rs = self::processFileRemoval($server, $pendingItem);
                        if ($rs === false) {
                            $db->query('UPDATE file_action '
                                    . 'SET status = \'failed\', '
                                    . 'status_msg=\'Could not delete file or folder, possible permissions issue or folder has contents.\', '
                                    . 'last_updated=NOW() '
                                    . 'WHERE id = ' . (int) $pendingItem['id'] . ' '
                                    . 'LIMIT 1');
                            continue;
                        }
                        break;
                    case 'move':
                        $actionDetails = json_decode($pendingItem['action_data'], true);
                        $params = array();
                        $params['file_id'] = (int) $pendingItem['file_id'];
                        $params['server_id'] = (int) $actionDetails['newServerId'];

                        // log
                        LogHelper::info('Move file request. file_action id = ' . $pendingItem['id']);

                        $url = AdminApiHelper::createApiUrl(_CONFIG_SITE_FULL_URL, $apiCredentials['apikey'], $apiCredentials['username'], 'movefile', $params);
                        $rs = CoreHelper::getRemoteUrlContent($url);

                        // log
                        LogHelper::info('Move file result: ' . print_r($rs, true) . ' file_action id = ' . $pendingItem['id']);

                        // handle failures
                        if ($rs === false) {
                            // log
                            LogHelper::error('Failed move file. file_action id = ' . $pendingItem['id']);
                            LogHelper::setContext($oldContext);

                            continue;
                        }
                        break;
                    case 'restore':
                        $restorePath = str_replace('_deleted/', '', $pendingItem['localFilePath']);
                        $newFileHash = md5_file($pendingItem['file_path']);
                        $rs = rename($pendingItem['file_path'], $restorePath);

                        // File restored, update the database
                        if ($rs === true) {
                            $db->query("UPDATE file_action "
                                    . "SET status_msg = 'file restoration complete', "
                                    . "last_updated=NOW() "
                                    . "WHERE id = " . (int) $pendingItem['id'] . " "
                                    . "LIMIT 1");
                            $db->query("UPDATE file "
                                    . "SET status = 'active', "
                                    . "fileHash = " . $db->quote($newFileHash) . " "
                                    . "WHERE id = " . (int) $pendingItem['id'] . " "
                                    . "LIMIT 1");

                            LogHelper::info('Restore file result: ' . print_r($rs, true) . ' file_action id = ' . $pendingItem['id']);
                            continue;
                        }

                        // File NOT restored, log the errors & update the db entry.
                        if (($rs === false) || ($strlen($restorePath) == 0)) {
                            // log
                            LogHelper::error('Failed file restoration. file_action id = ' . $pendingItem['id']);
                            LogHelper::setContext($oldContext);

                            $db->query('UPDATE file_action '
                                    . 'SET status = \'failed\', '
                                    . 'status_msg=\'Could not restore file.\', '
                                    . 'last_updated=NOW() '
                                    . 'WHERE id = ' . (int) $pendingItem['id'] . ' '
                                    . 'LIMIT 1');
                            continue;
                        }
                        break;
                }

                // update file record
                $db->query('UPDATE file_action '
                        . 'SET status = \'complete\', '
                        . 'last_updated=NOW() '
                        . 'WHERE id = ' . (int) $pendingItem['id'] . ' '
                        . 'LIMIT 1');
                continue;
            }
        }
    }

    /**
     * Remove the actual file.
     * 
     * @param type $storageServer
     * @param type $queueRow
     * @return boolean
     */
    static function processFileRemoval($uploadServerDetails, $queueRow) {
        // remove the actual file
        $filePath = $queueRow['file_path'];
        $storageType = $uploadServerDetails['serverType'];

        // remote - ftp
        if ($storageType == 'ftp') {
            // connect via ftp
            $conn_id = ftp_connect($uploadServerDetails['ipAddress'], $uploadServerDetails['ftpPort'], 30);
            if ($conn_id === false) {
                LogHelper::error('Could not connect to ' . $uploadServerDetails['ipAddress'] . ' to upload file.');
                return false;
            }

            // authenticate
            $login_result = ftp_login($conn_id, $uploadServerDetails['ftpUsername'], $uploadServerDetails['ftpPassword']);
            if ($login_result === false) {
                LogHelper::error('Could not login to ' . $uploadServerDetails['ipAddress'] . ' with supplied credentials.');
                return false;
            }

            // remove file
            if (!ftp_delete($conn_id, $filePath)) {
                // make sure file still exists before erroring
                $filePathNoName = str_replace(end(explode('/', $filePath)), '', $filePath);
                $file_list = ftp_nlist($conn_id, $filePathNoName);
                if ($file_list) {
                    if (in_array($filePath, $file_list)) {
                        LogHelper::error('Could not remove file on ' . $uploadServerDetails['ipAddress']);
                        return false;
                    }
                }
            }

            return true;
        }
        // remote - flysystem
        elseif (substr($storageType, 0, 10) == 'flysystem_') {
            $filesystem = FileServerContainerHelper::init($uploadServerDetails['id']);
            if (!$filesystem) {
                LogHelper::error('Could not setup adapter to delete file.');

                return false;
            }

            // remove the file
            try {
                // delete
                $rs = $filesystem->delete($filePath);
                if (!$rs) {
                    LogHelper::error('Could not delete file. Please contact support or try again.');

                    return false;
                }
            }
            catch (\Exception $e) {
                LogHelper::error($e->getMessage());

                return false;
            }

            return true;
        }

        // local & direct storage
        if (file_exists($filePath)) {
            // delete file or folder, this is the only option in this function for now
            if (is_dir($filePath)) {
                // directory
                $rs = rmdir($filePath);
            }
            else {
                // file
                $rs = unlink($filePath);
            }
        }

        return true;
    }

    /**
     * Queue file to be moved.
     * 
     * @param type $serverId
     * @param type $fromFilePath
     * @param type $fileId
     * @param type $newServerId
     * @return boolean|\DBObject
     */
    static function queueMoveFile($serverId, $fromFilePath, $fileId, $newServerId) {
        // if no action date passed, assume it needs done straight away
        if ($actionDate == null) {
            $actionDate = CoreHelper::sqlDateTime();
        }

        // create our FileAction object
        $fileAction = FileAction::create();
        $fileAction->file_id = $fileId;
        $fileAction->server_id = $serverId;
        $fileAction->file_path = $fromFilePath;
        $fileAction->file_action = 'move';
        $fileAction->action_data = json_encode(array('newServerId' => $newServerId));
        $fileAction->status = 'pending';
        $fileAction->date_created = CoreHelper::sqlDateTime();
        $fileAction->action_date = $actionDate;
        $fileAction->save();

        return $fileAction;
    }

    static function createSystemConfigTrackers() {
        // get file servers
        $fileServers = FileHelper::getFileServerData();
    }

}
