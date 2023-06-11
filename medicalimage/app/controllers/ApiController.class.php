<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Database;
use App\Models\File;
use App\Helpers\ApiV2Helper;
use App\Helpers\AuthHelper;
use App\Helpers\CoreHelper;
use App\Helpers\FileHelper;
use App\Helpers\LogHelper;
use App\Services\Uploader;

class ApiController extends BaseController
{

    public function index($urlPart1, $urlPart2 = '') {
        // requests from the same server don't have a HTTP_ORIGIN header
        if(!array_key_exists('HTTP_ORIGIN', $_SERVER))
        {
            $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
        }

        try
        {
            $fullEndpoint = $urlPart1;
            if(strlen($urlPart2)) {
                $fullEndpoint .= '/'.$urlPart2;
            }
            $apiv2 = ApiV2Helper::init($fullEndpoint, $_SERVER['HTTP_ORIGIN']);
            
            return $this->renderContent($apiv2->processAPI());
        }
        catch(\Exception $e)
        {
            // log
            $logParams = $apiv2->request;
            if(isset($logParams['password']))
            {
                unset($logParams['password']);
            }
            LogHelper::info('User Error: '.$e->getMessage().' - Params: '.json_encode($logParams, true));

            return $this->renderContent(json_encode(array('response' => $e->getMessage(), '_status' => 'error', '_datetime' => CoreHelper::sqlDateTime())));
        }
    }
    
    public function apiUploadHandler() {
        // for cross domain access
        CoreHelper::allowCrossSiteAjax();
        
        // pickup request for later
        $request = $this->getRequest();
        
        // setup database
        $db = Database::getDatabase();
        
        // logging
        LogHelper::setContext('api_upload_handler');
        LogHelper::info('POST request to API Uploader: ' . print_r($_REQUEST, true));

        // validate the api key
        $apiKey = $request->request->get('api_key');
        if (strlen($apiKey) === 0) {
            $rs = array();
            $rs[0] = array('error' => 'Please set the users API Key.');
            
            return $this->renderJson($rs);
        }
        else {
            // check API key in db
            $userId = $db->getValue("SELECT id "
                    . "FROM users "
                    . "WHERE apikey = :apikey "
                    . "LIMIT 1", array(
                        'apikey' => $apiKey,
                    ));
            if (!$userId) {
                $rs = array();
                $rs[0] = array('error' => 'Invalid API Key.');
                
                return $this->renderJson($rs);
            }
        }

        // pickup action
        $action = $request->request->has('action') ? $request->request->get('action') : 'upload';
        switch ($action) {
            // update raw file content
            case 'update_file_content':
                // look for file id
                if($request->request->has('file_id') === false) {
                    $rs = array();
                    $rs[0] = array('error' => 'File id not found.');
                    
                    return $this->renderJson($rs);
                }

                // load file
                $file = File::loadOneById((int) $request->request->get('file_id'));
                if (!$file) {
                    $rs = array();
                    $rs[0] = array('error' => 'Failed finding file.');
                    
                    return $this->renderJson($rs);
                }

                // check that the current user owns the file
                if ($file->userId != $userId) {
                    $rs = array();
                    $rs[0] = array('error' => 'Current user does not own the file.');
                    
                    return $this->renderJson($rs);
                }

                // setup uploader
                $uploadHandler = new Uploader(array(
                    'user_id' => (int) $userId,
                    'fail_zero_bytes' => false,
                    'min_file_size' => 0,
                    'upload_source' => 'api',
                ));

                // replace stored file
                $fileUpload = new \stdClass();
                $fileUpload->error = null;
                $rs = $uploadHandler->_storeFile($fileUpload, $_FILES['files']['tmp_name']);
                $file_size = $rs['file_size'];
                $file_path = $rs['file_path'];
                $uploadServerId = $rs['uploadServerId'];
                $fileUpload = $rs['fileUpload'];
                $relativeFilePath = $rs['relative_file_path'];
                $fileHash = $rs['fileHash'];
                $mimeType = FileHelper::estimateMimeTypeFromExtension($file->originalFilename);
                if (strlen($fileUpload->error)) {
                    $rs = array();
                    $rs[0] = array('error' => 'Error storing file: ' . $fileUpload->error);
                    
                    return $this->renderJson($rs);
                }

                // update existing file record in database
                $db = Database::getDatabase(true);
                $db->query('UPDATE file '
                        . 'SET fileSize = :fileSize, localFilePath = :localFilePath, '
                        . 'fileHash = :fileHash, fileType = :fileType '
                        . 'WHERE id = :id '
                        . 'LIMIT 1', array(
                            'fileSize' => $file_size,
                            'localFilePath' => $relativeFilePath,
                            'fileHash' => $fileHash,
                            'fileType' => $mimeType,
                            'id' => $file->id,
                            )
                        );

                // output success
                $rs = array();
                $rs[0] = array('success' => 'File updated.');
                
                return $this->renderJson($rs);
                break;
            // upload
            default:
                // setup uploader, allow zero file sizes
                if (!defined('PHP_INT_SIZE')) {
                    define('PHP_INT_SIZE', 4);
                }
                
                // setup auth for current user
                $Auth = AuthHelper::getAuth();
                $Auth->impersonate($userId);
                
                // setup upload handler
                $uploadHandler = new Uploader(array(
                    'folder_id' => (int) $request->request->get('folderId'),
                    'user_id' => (int) $userId,
                    'fail_zero_bytes' => false,
                    'min_file_size' => 0,
                    'max_file_size' => PHP_INT_SIZE === 8 ? 1072870912000 : 2147483647,
                    'upload_source' => 'api',
                ));

                switch ($request->server->get('REQUEST_METHOD')) {
                    case 'POST':
                        return $this->renderContent($uploadHandler->post());
                }
                break;
        }


        // fallback
        return $this->renderContent('');
    }
}
