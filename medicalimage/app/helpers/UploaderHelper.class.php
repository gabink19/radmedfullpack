<?php

namespace App\Helpers;

use App\Core\Database;
use App\Helpers\CacheHelper;
use App\Helpers\FileFolderHelper;
use App\Helpers\FileHelper;
use App\Helpers\FileServerHelper;
use App\Helpers\LogHelper;
use App\Helpers\PluginHelper;
use App\Helpers\TranslateHelper;
use App\Models\User;
use App\Models\UserLevel;
use App\Services\Password;
use App\Services\PasswordPolicy;
use App\Services\Uploader;

class UploaderHelper
{
    const REMOTE_URL_UPLOAD_FEEDBACK_CHUNKS_BYTES = 200000; // how often to supply feedback on the url uploader

    static public function checkBannedFiles($fileHash, $fileSize) {
        // get database connection
        $db = Database::getDatabase();
        $isFileBanned = $db->getRow("SELECT * "
                . "FROM banned_files "
                . "WHERE fileHash = :fileHash "
                . "AND fileSize = :fileSize", array(
                    'fileHash' => $fileHash,
                    'fileSize' => $fileSize,
                ));

        if (is_array($isFileBanned)) {
            return true;
        }

        return false;
    }

    static public function getLocalTempStorePath() {
        $tmpDir = FileServerHelper::getCurrentServerFileStoragePath() . '_tmp/';
        if (!file_exists($tmpDir)) {
            @mkdir($tmpDir);
        }

        if (!file_exists($tmpDir)) {
            self::exitWithError('Failed creating tmp storage folder for chunked '
                    . 'uploads. Ensure the parent folder has write permissions: ' . $tmpDir);
        }

        if (!is_writable($tmpDir)) {
            self::exitWithError('Temp storage folder for uploads is not writable. '
                    . 'Ensure it has CHMOD 755 or 777 permissions: ' . $tmpDir);
        }

        return $tmpDir;
    }

    static function generateSuccessHtml($fileUpload, $uploadSource = 'direct') {
        // get auth for later
        $Auth = AuthHelper::getAuth();

        // load user folders for later
        $userFolders = FileFolderHelper::loadAllActiveByAccount($Auth->id);

        // generate html
        $success_result_html = '';
        $success_result_html .= '<td class="cancel">';
        $success_result_html .= '   <img src="' . CoreHelper::getCoreSitePath() . '/themes/' . SITE_CONFIG_SITE_THEME . '/assets/images/green_tick_small.png" height="16" width="16" alt="success"/>';
        $success_result_html .= '</td>';
        $success_result_html .= '<td class="name">';
        $success_result_html .= $fileUpload->name;
        $success_result_html .= '<div class="sliderContent" style="display: none;">';
        $success_result_html .= '        <!-- popup content -->';
        $success_result_html .= '        <table width="100%">';
        $success_result_html .= '            <tr>';
        $success_result_html .= '                <td class="odd" style="width: 90px; border-top:1px solid #fff;">';
        $success_result_html .= '                    <label>' . TranslateHelper::t('download_url', 'Download Url') . ':</label>';
        $success_result_html .= '                </td>';
        $success_result_html .= '                <td class="odd ltrOverride" style="border-top:1px solid #fff;">';
        $success_result_html .= '                    <a href="' . $fileUpload->url . '" target="_blank">' . $fileUpload->url . '</a>';
        $success_result_html .= '                </td>';
        $success_result_html .= '            </tr>';
        $success_result_html .= '            <tr>';
        $success_result_html .= '                <td class="even">';
        $success_result_html .= '                    <label>' . TranslateHelper::t('html_code', 'HTML Code') . ':</label>';
        $success_result_html .= '                </td>';
        $success_result_html .= '                <td class="even htmlCode ltrOverride" onClick="return false;">';
        $success_result_html .= '                    &lt;a href=&quot;' . $fileUpload->info_url . '&quot; target=&quot;_blank&quot; title=&quot;' . TranslateHelper::t('download from', 'Download From') . ' ' . SITE_CONFIG_SITE_NAME . '&quot;&gt;' . TranslateHelper::t('download', 'Download') . ' ' . $fileUpload->name . ' ' . TranslateHelper::t('from', 'from') . ' ' . SITE_CONFIG_SITE_NAME . '&lt;/a&gt;';
        $success_result_html .= '                </td>';
        $success_result_html .= '            </tr>';
        $success_result_html .= '            <tr>';
        $success_result_html .= '                <td class="odd">';
        $success_result_html .= '                    <label>' . TranslateHelper::t('forum_code', 'Forum Code') . ':</label>';
        $success_result_html .= '                </td>';
        $success_result_html .= '                <td class="odd htmlCode ltrOverride">';
        $success_result_html .= '                    [url]' . $fileUpload->url . '[/url]';
        $success_result_html .= '                </td>';
        $success_result_html .= '            </tr>';
        $success_result_html .= '            <tr>';
        $success_result_html .= '                <td class="even">';
        $success_result_html .= '                    <label>' . TranslateHelper::t('stats_url', 'Stats Url') . ':</label>';
        $success_result_html .= '                </td>';
        $success_result_html .= '                <td class="even ltrOverride">';
        $success_result_html .= '                    <a href="' . $fileUpload->stats_url . '" target="_blank">' . $fileUpload->stats_url . '</a>';
        $success_result_html .= '                </td>';
        $success_result_html .= '            </tr>';
        $success_result_html .= '            <tr>';
        $success_result_html .= '                <td class="odd">';
        $success_result_html .= '                    <label>' . TranslateHelper::t('delete_url', 'Delete Url') . ':</label>';
        $success_result_html .= '                </td>';
        $success_result_html .= '                <td class="odd ltrOverride">';
        $success_result_html .= '                    <a href="' . $fileUpload->delete_url . '" target="_blank">' . $fileUpload->delete_url . '</a>';
        $success_result_html .= '                </td>';
        $success_result_html .= '            </tr>';
        $success_result_html .= '            <tr>';
        $success_result_html .= '                <td class="even">';
        $success_result_html .= '                    <label>' . TranslateHelper::t('full_info', 'Full Info') . ':</label>';
        $success_result_html .= '                </td>';
        $success_result_html .= '                <td class="even htmlCode ltrOverride">';
        $success_result_html .= '                    <a href="' . $fileUpload->info_url . '" target="_blank" onClick="window.open(\'' . $fileUpload->info_url . '\'); return false;">[' . TranslateHelper::t('click_here', 'click here') . ']</a>';
        $success_result_html .= '                </td>';
        $success_result_html .= '            </tr>';

        /*
          if ($Auth->loggedIn() && COUNT($userFolders))
          {
          $success_result_html .= '                <tr>';
          $success_result_html .= '                    <td class="odd">';
          $success_result_html .= '                        <label>' . TranslateHelper::t('save_to_folder',
          'Save To Folder') . ':</label>';
          $success_result_html .= '                    </td>';
          $success_result_html .= '                    <td class="odd">';
          $success_result_html .= '                        <form>';
          $success_result_html .= '                            <select name="folderId" id="folderId" class="saveToFolder" onChange="saveFileToFolder(this); return false;">';
          $success_result_html .= '                                <option value="">- ' . TranslateHelper::t('none',
          'none') . ' -</option>';
          foreach ($userFolders AS $userFolder)
          {
          $success_result_html .= '                                    <option value="' . $userFolder['id'] . '">' . htmlentities($userFolder['folderName']) . '</option>';
          }
          $success_result_html .= '                            </select>';
          $success_result_html .= '                        </form>';
          $success_result_html .= '                    </td>';
          $success_result_html .= '                </tr>';
          }
         * 
         */

        $success_result_html .= '        </table>';
        $success_result_html .= '        <input type="hidden" value="' . $fileUpload->short_url . '" name="shortUrlHidden" class="shortUrlHidden"/>';
        $success_result_html .= '    </div>';
        $success_result_html .= '</td>';
        $success_result_html .= '<td class="rightArrow"><img src="' . CoreHelper::getCoreSitePath() . '/themes/' . SITE_CONFIG_SITE_THEME . '/assets/images/blue_right_arrow.png" width="8" height="6" /></td>';
        $success_result_html .= '<td class="url urlOff">';
        $success_result_html .= '    <a href="' . $fileUpload->url . '" target="_blank">' . $fileUpload->url . '</a>';
        $success_result_html .= '    <div class="fileUrls hidden">' . $fileUpload->url . '</div>';
        $success_result_html .= '</td>';

        // call plugin hooks
        $params = PluginHelper::callHook('uploaderSuccessResultHtml', array(
                'success_result_html' => $success_result_html,
                'fileUpload' => $fileUpload,
                'userFolders' => $userFolders,
                'uploadSource' => $uploadSource,
        ));

        $success_result_html = $params['success_result_html'];

        return $success_result_html;
    }

    static function generateErrorHtml($fileUpload) {
        // get auth for later
        $Auth = AuthHelper::getAuth();

        // generate html
        $error_result_html = '';
        $error_result_html .= '<td class="cancel">';
        $error_result_html .= '   <img src="' . CoreHelper::getCoreSitePath() . '/themes/' . SITE_CONFIG_SITE_THEME . '/assets/images/red_error_small.png" height="16" width="16" alt="error"/>';
        $error_result_html .= '</td>';

        $error_result_html .= '<td class="name">' . $fileUpload->name . '</td>';

        $error_result_html .= '<td class="error" colspan="2">' . TranslateHelper::t('classuploader_error', 'Error') . ': ';
        $error_result_html .= self::translateError($fileUpload->error);
        $error_result_html .= '</td>';

        // check plugins so the resulting html can be overwritten if set
        $params = PluginHelper::includeAppends('class_uploader_error_result_html.php', array('error_result_html' => $error_result_html, 'fileUpload' => $fileUpload));
        $error_result_html = $params['error_result_html'];

        return $error_result_html;
    }

    static function translateError($error) {
        switch ($error) {
            case 1:
                return TranslateHelper::t('file_exceeds_upload_max_filesize_php_ini_directive', 'File exceeds upload_max_filesize (php.ini directive)');
            case 2:
                return TranslateHelper::t('file_exceeds_max_file_size_html_form_directive', 'File exceeds MAX_FILE_SIZE (HTML form directive)');
            case 3:
                return TranslateHelper::t('file_was_only_partially_uploaded', 'File was only partially uploaded');
            case 4:
                return TranslateHelper::t('no_file_was_uploaded', 'No File was uploaded');
            case 5:
                return TranslateHelper::t('missing_a_temporary_folder', 'Missing a temporary folder');
            case 6:
                return TranslateHelper::t('failed_to_write_file_to_disk', 'Failed to write file to disk');
            case 7:
                return TranslateHelper::t('file_upload_stopped_by_extension', 'File upload stopped by extension');
            case 'maxFileSize':
                return TranslateHelper::t('file_is_too_big', 'File is too big');
            case 'minFileSize':
                return TranslateHelper::t('file_is_too_small', 'File is too small');
            case 'acceptFileTypes':
                return TranslateHelper::t('filetype_is_not_allowed', 'Filetype not allowed');
            case 'maxNumberOfFiles':
                return TranslateHelper::t('max_number_of_files_exceeded', 'Max number of files exceeded');
            case 'uploadedBytes':
                return TranslateHelper::t('uploaded_bytes_exceed_file_size', 'Uploaded bytes exceed file size');
            case 'emptyResult':
                return TranslateHelper::t('empty_file_upload_result', 'Empty file upload result');
            default:
                return $error;
        }
    }

    static function exitWithError($errorStr) {
        // log
        LogHelper::error('UploaderHelper: ' . $errorStr);

        $fileUpload = new \stdClass();
        $fileUpload->error = $errorStr;
        $errorHtml = self::generateErrorHtml($fileUpload);
        $fileUpload->error_result_html = $errorHtml;
        echo json_encode(array($fileUpload), true);
        die();
    }

    static function addUrlToBackgroundQueue($url, $userId, $folderId = null) {
        // make sure we have a user id
        if ($userId == 0) {
            return false;
        }

        // database connection
        $db = Database::getDatabase();

        // current file server if
        $currentFileServerId = FileHelper::getCurrentServerId();

        // make sure it's not already queued for this user
        $found = $db->getValue('SELECT id '
                . 'FROM remote_url_download_queue '
                . 'WHERE user_id=:user_id '
                . 'AND url=:url '
                . 'AND (job_status=\'downloading\' OR job_status=\'pending\' OR job_status=\'processing\') '
                . 'LIMIT 1', array(
            'user_id' => $userId,
            'url' => $url,
        ));
        if ($found) {
            return true;
        }

        // add to backgroud queue
        return $db->query("INSERT INTO remote_url_download_queue (user_id, url, file_server_id, created, folder_id) "
                        . "VALUES (:user_id, :url, :file_server_id, NOW(), :folder_id)", array(
                    'user_id' => (int) $userId,
                    'url' => $url,
                    'file_server_id' => $currentFileServerId,
                    'folder_id' => $folderId,
                        )
        );
    }

    static function uploadingDisabled() {
        // check for admin user
        $Auth = AuthHelper::getAuth();
        if ($Auth->loggedIn()) {
            if ($Auth->level_id == 20) {
                return false;
            }
        }

        if (defined('SITE_CONFIG_UPLOADS_BLOCK_ALL') && (SITE_CONFIG_UPLOADS_BLOCK_ALL == 'yes')) {
            return true;
        }

        return false;
    }

    static public function getUrlParts($url) {
        return parse_url($url);
    }
}
