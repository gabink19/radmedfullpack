<?php



namespace App\Services;



use App\Core\Database;

use App\Helpers\AuthHelper;

use App\Helpers\CoreHelper;

use App\Helpers\FileFolderHelper;

use App\Helpers\FileHelper;

use App\Helpers\FileServerContainerHelper;

use App\Helpers\FileServerHelper;

use App\Helpers\LogHelper;

use App\Helpers\PluginHelper;

use App\Helpers\TranslateHelper;

use App\Helpers\UploaderHelper;

use App\Helpers\UserHelper;

use App\Models\File;



class Uploader

{

    public $options;

    public $nextFeedbackTracker;

    public $rowId;

    public $fileUpload = null;



    function __construct($options = null) {

        // get accepted file types

        $acceptedFileTypes = UserHelper::getAcceptedFileTypes();



        // get blocked file types

        $blockedFileTypes = UserHelper::getBlockedFileTypes();



        // get blocked file keywords

        $blockedFileKeywords = UserHelper::getBlockedFilenameKeywords();



        if (isset($options['max_chunk_size'])) {

            $this->options['max_chunk_size'] = (int) $options['max_chunk_size'];

        }



        // get logged in user details

        $Auth = AuthHelper::getAuth();

        $userId = null;

        if ($Auth->loggedIn()) {

            $userId = $Auth->id;

        }



        // default options

        $this->options = array(

            'script_url' => $_SERVER['PHP_SELF'],

            'upload_dir' => FileServerHelper::getCurrentServerFileStoragePath(),

            'upload_url' => dirname($_SERVER['PHP_SELF']) . '/files/',

            'param_name' => 'files',

            'delete_hash' => '',

            'max_file_size' => $this->getMaxUploadSize(),

            'min_file_size' => 1,

            'accept_file_types' => COUNT($acceptedFileTypes) ? ('/(\.|\/)(' . str_replace(".", "", implode("|", $acceptedFileTypes)) . ')$/i') : '/.+$/i',

            'block_file_types' => COUNT($blockedFileTypes) ? ('/(\.|\/)(' . str_replace(".", "", implode("|", $blockedFileTypes)) . ')$/i') : '',

            'block_file_keywords' => $blockedFileKeywords,

            'max_number_of_files' => null,

            'discard_aborted_uploads' => true,

            'max_chunk_size' => 0,

            'folder_id' => 0,

            'user_id' => $userId,

            'uploaded_user_id' => $userId,

            'fail_zero_bytes' => true,

            'upload_source' => 'direct',

            'background_queue_id' => null,

        );



        if ($options) {

            $this->options = array_replace_recursive($this->options, $options);



            // make sure any the uploaded_user_id is copied, encase the above overrode it

            if ($this->options['uploaded_user_id'] === null && $this->options['user_id'] !== null) {

                $this->options['uploaded_user_id'] = $this->options['user_id'];

            }

        }

    }



    public function getMaxUploadSize() {

        // max allowed upload size

        return UserHelper::getMaxUploadFilesize();

    }



    public function getAvailableStorage() {

        // initialize current user

        $Auth = AuthHelper::getAuth();



        // available storage

        $availableStorage = UserHelper::getAvailableFileStorage($Auth->id);



        return $availableStorage;

    }



    public function getFileObject($file_name) {

        $file_path = $this->options['upload_dir'] . $file_name;

        if (is_file($file_path) && $file_name[0] !== '.') {

            $file = new \stdClass();

            $file->name = $file_name;

            $file->size = filesize($file_path);

            $file->url = $this->options['upload_url'] . rawurlencode($file->name);

            $file->delete_url = '~d?' . $this->options['delete_hash'];

            $file->info_url = '~i?' . $this->options['delete_hash'];

            $file->delete_type = 'DELETE';

            $file->delete_hash = $this->options['delete_hash'];



            return $file;

        }



        return null;

    }



    public function hasError($uploadedFile, $file, $error = null) {

        // make sure uploading hasn't been disabled

        if (UploaderHelper::uploadingDisabled() == true) {

            return TranslateHelper::t('uploader_all_blocked', 'Uploading is currently disabled on the site, please try again later.');

        }

        

        if ($error) {

            return $error;

        }

        

        if (!preg_match($this->options['accept_file_types'], $file->name)) {

            return 'acceptFileTypes';

        }



        if ($this->options['block_file_types']) {

            if (preg_match($this->options['block_file_types'], $file->name)) {

                return TranslateHelper::t('uploader_blocked_filetype', 'File could not be uploaded due to that file type being banned by the site admin');

            }

        }



        // check for blocked strings within the filename

        if (COUNT($this->options['block_file_keywords'])) {

            foreach ($this->options['block_file_keywords'] AS $keyword) {

                if (stripos($file->name, $keyword) !== false) {

                    return TranslateHelper::t('uploader_blocked_file_keyword', 'File could not be uploaded as the filename was blocked');

                }

            }

        }



        // check for blocked file hashes

        $md5FileHash = md5_file($uploadedFile);

        $isBlocked = FileHelper::checkFileHashBlocked($md5FileHash);

        if ($isBlocked) {

            return TranslateHelper::t('uploader_blocked_file_hash_content', 'File content has been blocked from being uploaded.');

        }



        if ($uploadedFile && file_exists($uploadedFile)) {

            $file_size = filesize($uploadedFile);

        }

        else {

            $file_size = $_SERVER['CONTENT_LENGTH'];

        }

        if ($this->options['max_file_size'] && ($file_size > $this->options['max_file_size'] || $file->size > $this->options['max_file_size'])) {

            return 'maxFileSize';

        }

        if ($this->options['min_file_size'] && $file_size < $this->options['min_file_size']) {

            return 'minFileSize';

        }

        if (is_int($this->options['max_number_of_files']) && (count($this->getFileObjects()) >= $this->options['max_number_of_files'])) {

            return 'maxNumberOfFiles';

        }



        return null;

    }



    public function handleFileUpload($uploadedFile, $name, $size, $type, $error, $index = null, $contentRange = null, $chunkTracker = null) {

        $fileUpload = new \stdClass();

        $fileUpload->name = stripslashes($name);

        $fileUpload->size = intval($size);

        $fileUpload->type = $type;

        $fileUpload->error = null;



        // save file locally if chunked upload

        if ($contentRange) {

            $localTempStore = UploaderHelper::getLocalTempStorePath();

            $tmpFilename = md5($fileUpload->name);

            $tmpFilePath = $localTempStore . $tmpFilename;



            // if first chunk

            if ($contentRange[1] == 0) {

                // ensure the tmp file does not already exist

                if (file_exists($tmpFilePath)) {

                    unlink($tmpFilePath);

                }



                // first clean up any old chunks

                $this->cleanLeftOverChunks();

            }



            // ensure we have the chunk

            if ($uploadedFile && file_exists($uploadedFile)) {

                // multipart/formdata uploads (POST method uploads)

                $fp = fopen($uploadedFile, 'r');

                file_put_contents($tmpFilePath, $fp, FILE_APPEND);

                fclose($fp);



                // check if this is not the last chunk

                if ($contentRange[3] != filesize($tmpFilePath)) {

                    // exit

                    return $fileUpload;

                }



                // otherwise assume we have the whole file

                $uploadedFile = $tmpFilePath;

                $fileUpload->size = filesize($tmpFilePath);

            }

            else {

                // exit

                return $fileUpload;

            }

        }



        $fileUpload->error = $this->hasError($uploadedFile, $fileUpload, $error);

        if (!$fileUpload->error) {

            if (strlen(trim($fileUpload->name)) == 0) {

                $fileUpload->error = TranslateHelper::t('classuploader_filename_not_found', 'Filename not found.');

            }

        }

        elseif ((intval($size) == 0) && ($this->options['fail_zero_bytes'] == true)) {

            $fileUpload->error = TranslateHelper::t('classuploader_file_received_has_zero_size', 'File received has zero size. This is likely an issue with the maximum permitted size within PHP');

        }

        elseif (intval($size) > $this->options['max_file_size']) {

            $fileUpload->error = TranslateHelper::t('classuploader_file_received_larger_than_permitted', 'File received is larger than permitted. (max [[[MAX_FILESIZE]]])', array('MAX_FILESIZE' => CoreHelper::formatSize($this->options['max_file_size'])));

        }



        if (!$fileUpload->error && $fileUpload->name) {

            $fileUpload = $this->moveIntoStorage($fileUpload, $uploadedFile);

        }



        // no error, add success html

        if ($fileUpload->error === null) {

            $fileUpload->url_html = '&lt;a href=&quot;' . $fileUpload->url . '&quot; target=&quot;_blank&quot; title=&quot;' . TranslateHelper::t('view_image_on', 'View image on') . ' ' . SITE_CONFIG_SITE_NAME . '&quot;&gt;' . TranslateHelper::t('view', 'View') . ' ' . $fileUpload->name . ' ' . TranslateHelper::t('on', 'on') . ' ' . SITE_CONFIG_SITE_NAME . '&lt;/a&gt;';

            $fileUpload->url_bbcode = '[url]' . $fileUpload->url . '[/url]';

            $fileUpload->success_result_html = UploaderHelper::generateSuccessHtml($fileUpload, $this->options['upload_source']);

        }

        else {

            $fileUpload->error_result_html = UploaderHelper::generateErrorHtml($fileUpload);

        }



        return $fileUpload;

    }



    public function get() {

        $file_name = isset($_REQUEST['file']) ?

                basename(stripslashes($_REQUEST['file'])) : null;

        $info = array();

        if ($file_name) {

            $info = $this->getFileObject($file_name);

        }

        header('Content-type: application/json');

        

        return json_encode($info);

    }



    public function post() {

        $upload = isset($_FILES[$this->options['param_name']]) ?

                $_FILES[$this->options['param_name']] : array(

            'tmp_name' => null,

            'name' => null,

            'size' => null,

            'type' => null,

            'error' => null

        );


        // parse the Content-Disposition header, if available:

        $fileName = $this->getServerVar('HTTP_CONTENT_DISPOSITION') ?

                rawurldecode(preg_replace(

                                '/(^[^"]+")|("$)/', '', $this->getServerVar('HTTP_CONTENT_DISPOSITION')

                )) : null;



        // parse the Content-Range header, which has the following form:

        // Content-Range: bytes 0-524287/2000000

        $contentRange = $this->getServerVar('HTTP_CONTENT_RANGE') ?

                preg_split('/[^0-9]+/', $this->getServerVar('HTTP_CONTENT_RANGE')) : null;

        $size = $contentRange ? $contentRange[3] : null;



        $info = array();

        if (is_array($upload['tmp_name'])) {

            foreach ($upload['tmp_name'] as $index => $value) {

                $info[] = $this->handleFileUpload(

                        $upload['tmp_name'][$index], isset($_SERVER['HTTP_X_FILE_NAME']) ? $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index], isset($_SERVER['HTTP_X_FILE_SIZE']) ? $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index], isset($_SERVER['HTTP_X_FILE_TYPE']) ? $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index], $upload['error'][$index], $index, $contentRange, isset($_REQUEST['cTracker']) ? $_REQUEST['cTracker'] : null

                );

            }

        }

        else {

            $info[] = $this->handleFileUpload(

                    $upload['tmp_name'], isset($_SERVER['HTTP_X_FILE_NAME']) ? $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'], isset($_SERVER['HTTP_X_FILE_SIZE']) ? $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'], isset($_SERVER['HTTP_X_FILE_TYPE']) ? $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'], $upload['error'], null, $contentRange, isset($_REQUEST['cTracker']) ? $_REQUEST['cTracker'] : null

            );

        }

        header('Vary: Accept');

        if (isset($_SERVER['HTTP_ACCEPT']) &&

                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {

            header('Content-type: application/json');

        }

        else {

            header('Content-type: text/plain');

        }

        

        return json_encode($info);

    }



    public function handleRemoteUrlUpload($url, $rowId = 0, $gbr_up = null) {

        $this->rowId = $rowId;

        $this->nextFeedbackTracker = UploaderHelper::REMOTE_URL_UPLOAD_FEEDBACK_CHUNKS_BYTES;



        $this->fileUpload = new \stdClass();



        // filename

        $realFilename = trim(end(explode('/', $url)));



        // remove anything before a question mark

        $realFilename = trim(current(explode('?', $realFilename)));

        $realFilename = trim(current(explode(';', $realFilename)));

        if (strlen($realFilename) == 0) {

            $realFilename = 'file.txt';

        }

        // decode filename

        $realFilename = urldecode($realFilename);

        $this->fileUpload->name = $realFilename;



        $this->fileUpload->size = 0;

        $this->fileUpload->type = '';

        $this->fileUpload->error = null;

        $this->fileUpload->rowId = $rowId;

        $this->fileUpload->requestUrl = $url;



        $remoteFileDetails = $this->getRemoteFileDetails($url);

        $remoteFilesize = (int) $remoteFileDetails['bytes'];

        if($gbr_up!==null){
            $this->options['max_file_size'] = UserHelper::getMaxUploadFilesize(20);
        }

        if ($remoteFilesize > $this->options['max_file_size']) {

            $this->fileUpload->error = TranslateHelper::t('classuploader_file_larger_than_permitted', 'File is larger than permitted. (max [[[MAX_FILESIZE]]])', array('MAX_FILESIZE' => CoreHelper::formatSize($this->options['max_file_size'])));

        }

        else {

            // look for real filename if passed in headers

            if (strlen($remoteFileDetails['real_filename'])) {

                $realFilename = trim(current(explode(';', $remoteFileDetails['real_filename'])));

                if (strlen($realFilename)) {

                    $this->fileUpload->name = $realFilename;

                }

            }



            // try to get the file locally

            $localFile = $this->downloadRemoteFile($url, true);



            // reconnect db if it's gone away

            $db = Database::getDatabase(true);

            $db->close();

            $db = Database::getDatabase(true);



            if ($localFile === false) {

                $this->fileUpload->error = TranslateHelper::t('classuploader_could_not_get_remote_file', 'Could not get remote file. [[[FILE_URL]]]', array('FILE_URL' => $url));

            }

            else {

                $size = (int) filesize($localFile);

                $this->fileUpload->error = $this->hasError($localFile, $this->fileUpload);

                if (!$this->fileUpload->error) {

                    if (strlen(trim($this->fileUpload->name)) == 0) {

                        $this->fileUpload->error = TranslateHelper::t('classuploader_filename_not_found', 'Filename not found.');

                    }

                }

                elseif (intval($size) == 0) {

                    $this->fileUpload->error = TranslateHelper::t('classuploader_file_has_zero_size', 'File received has zero size.');

                }

                elseif (intval($size) > $this->options['max_file_size']) {

                    $this->fileUpload->error = TranslateHelper::t('classuploader_file_received_larger_than_permitted', 'File received is larger than permitted. (max [[[MAX_FILESIZE]]])', array('MAX_FILESIZE' => CoreHelper::formatSize($this->options['max_file_size'])));

                }



                if (!$this->fileUpload->error && $this->fileUpload->name) {

                    // filesize

                    $this->fileUpload->size = filesize($localFile);



                    // get mime type

                    $mimeType = FileHelper::estimateMimeTypeFromExtension($this->fileUpload->name, 'application/octet-stream');

                    if (($mimeType == 'application/octet-stream') && (class_exists('finfo', false))) {

                        $finfo = new \finfo;

                        $mimeType = $finfo->file($localFile, FILEINFO_MIME);

                    }

                    $this->fileUpload->type = $mimeType;



                    // save into permanent storage

                    $this->fileUpload = $this->moveIntoStorage($this->fileUpload, $localFile);

                }

                else {

                    @unlink($localFile);

                }

            }

        }



        // no error, add success html

        if ($this->fileUpload->error === null) {

            $this->fileUpload->url_html = '&lt;a href=&quot;' . $this->fileUpload->url . '&quot; target=&quot;_blank&quot; title=&quot;' . TranslateHelper::t('view_image_on', 'View image on') . ' ' . SITE_CONFIG_SITE_NAME . '&quot;&gt;' . TranslateHelper::t('view', 'View') . ' ' . $this->fileUpload->name . ' ' . TranslateHelper::t('on', 'on') . ' ' . SITE_CONFIG_SITE_NAME . '&lt;/a&gt;';

            $this->fileUpload->url_bbcode = '[url]' . $this->fileUpload->url . '[/url]';

            $this->fileUpload->success_result_html = UploaderHelper::generateSuccessHtml($this->fileUpload, $this->options['upload_source']);

        }

        else {

            $this->fileUpload->error_result_html = UploaderHelper::generateErrorHtml($this->fileUpload);

        }



        $this->remote_url_event_callback(array("done" => $this->fileUpload));

    }



    public function getRemoteFileDetails($url) {

        $rs = array();

        $rs['bytes'] = 0;

        $rs['real_filename'] = null;

        if (function_exists('curl_init')) {

            // initialize curl with given url

            if ($ch === null) {

                $ch = curl_init();

            }

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HEADER, true);

            curl_setopt($ch, CURLOPT_NOBODY, true);

            curl_setopt($ch, CURLOPT_REFERER, $url);

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            curl_setopt($ch, CURLOPT_REDIR_PROTOCOLS, CURLPROTO_HTTP | CURLPROTO_HTTPS);

            curl_setopt($ch, CURLOPT_MAXREDIRS, 15);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

            curl_setopt($ch, CURLOPT_FAILONERROR, true);

            $execute = curl_exec($ch);



            // check if any error occured

            if (!curl_errno($ch)) {

                $rs['bytes'] = (int) curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);



                // this catches filenames between quotes

                if (preg_match('/.*filename=[\'\"]([^\'\"]+)/', $execute, $matches)) {

                    $rs['real_filename'] = $matches[1];

                }

                // if filename is not quoted, we take all until the next space

                elseif (preg_match("/.*filename=([^ ]+)/", $execute, $matches)) {

                    $rs['real_filename'] = $matches[1];

                }



                // make sure there are no quotes

                $rs['real_filename'] = str_replace('"', '', $rs['real_filename']);

            }



            curl_close($ch);

        }

        else {

            UploaderHelper::exitWithError(TranslateHelper::t('classuploader_curl_module_not_found', 'Curl module not found. Please enable within PHP to enable remote uploads.'));

        }



        return $rs;

    }



    public function downloadRemoteFile($url, $streamResponse = false) {

        // save locally

        $tmpDir = UploaderHelper::getLocalTempStorePath();

        $tmpName = md5($url . microtime());

        $tmpFullPath = $tmpDir . $tmpName;



        // extract username and password, if available

        $urlParts = UploaderHelper::getUrlParts($url);

        $urlUser = null;

        $urlPass = null;

        if ((isset($urlParts['user'])) && (strlen($urlParts['user']))) {

            $urlUser = $urlParts['user'];

        }

        if ((isset($urlParts['pass'])) && (strlen($urlParts['pass']))) {

            $urlPass = $urlParts['pass'];

        }



        // use curl

        if (function_exists('curl_init')) {

            // get file via curl

            $fp = fopen($tmpFullPath, 'w+');

            if ($ch === null) {

                $ch = curl_init();

            }



            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_NOBODY, false);

            curl_setopt($ch, CURLOPT_REFERER, $url);

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            curl_setopt($ch, CURLOPT_REDIR_PROTOCOLS, CURLPROTO_HTTP | CURLPROTO_HTTPS);

            curl_setopt($ch, CURLOPT_MAXREDIRS, 15);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_TIMEOUT, 60 * 60 * 24); // 24 hours

            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); // 15 seconds

            curl_setopt($ch, CURLOPT_HEADER, false);

            // allow for http auth

            if ($urlUser != null) {

                curl_setopt($ch, CURLOPT_USERPWD, $urlUser . ':' . $urlPass);

            }

            if ($streamResponse === true) {

                curl_setopt($ch, CURLOPT_NOPROGRESS, false);

                curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, array($this, 'remoteUrlCurlProgressCallback'));

            }

            //curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

            curl_setopt($ch, CURLOPT_FILE, $fp);

            if (curl_exec($ch) === false) {

                // log error

                LogHelper::error('Failed getting url. Error: ' . curl_error($ch) . ' (' . $url . ')');

                return false;

            }

            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            fclose($fp);



            // remove if no a valid status code

            if (($status === 404) || ($status === 401)) {

                @unlink($tmpFullPath);

            }

        }

        // use file_get_contents

        else {

            if (function_exists('stream_context_create')) {

                $httpArr = array(

                    'timeout' => 15, // 15 seconds

                );



                if ($streamResponse === true) {

                    $httpArr['notification'] = array($this, 'remoteUrlCurlProgressCallback');

                }



                if ($urlUser != null) {

                    $httpArr['header'] = "Authorization: Basic " . base64_encode($urlUser . ':' . $urlPass);

                }



                $ctx = stream_context_create(array('http' =>

                    $httpArr

                ));

            }



            // get file content

            $fileData = @file_get_contents($url);

            @file_put_contents($tmpFullPath, $fileData);

        }



        // test to see if we saved the file

        if ((file_exists($tmpFullPath)) && (filesize($tmpFullPath) > 0)) {

            return $tmpFullPath;

        }



        // clear blank file

        if (file_exists($tmpFullPath)) {

            @unlink($tmpFullPath);

        }



        return false;

    }



    function remote_url_event_callback($message) {

        echo "<script>parent.updateUrlProgress(" . json_encode($message) . ");</script>";

        ob_flush();

        flush();

    }



    function remote_url_stream_notification_callback($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) {

        if ($notification_code == STREAM_NOTIFY_PROGRESS) {

            if ($bytes_transferred) {

                if ($bytes_transferred > $this->nextFeedbackTracker) {

                    $this->remote_url_event_callback(array(

                        "progress" => array(

                            "loaded" => $bytes_transferred,

                            "total" => $bytes_max,

                            "rowId" => $this->rowId,

                        )

                    ));

                    $this->nextFeedbackTracker = $this->nextFeedbackTracker + UploaderHelper::REMOTE_URL_UPLOAD_FEEDBACK_CHUNKS_BYTES;

                }

            }

        }

    }



    function remoteUrlCurlProgressCallback($download_size, $downloaded_size, $upload_size, $uploaded_size, $other = null) {

        // allow for the new option added AT THE BEGINNING! in PHP v5.5

        if (is_resource($download_size)) {

            $download_size = $downloaded_size;

            $downloaded_size = $upload_size;

            $upload_size = $uploaded_size;

            $uploaded_size = $other;

        }



        // log in the database or on screen

        if ((int) $this->options['background_queue_id']) {

            $db = Database::getDatabase(true);

            $percent = ceil(($downloaded_size / $download_size) * 100);

            $db->query('UPDATE remote_url_download_queue '

                    . 'SET downloaded_size=:downloaded_size, '

                    . 'total_size=:total_size, '

                    . 'download_percent=:download_percent '

                    . 'WHERE id=:id '

                    . 'LIMIT 1', array(

                        'downloaded_size' => $downloaded_size,

                        'total_size' => $download_size,

                        'download_percent' => (int)$percent,

                        'id' => (int) $this->options['background_queue_id'],

                    ));



            // stop loads of loops

            $next = UploaderHelper::REMOTE_URL_UPLOAD_FEEDBACK_CHUNKS_BYTES;

            if ($download_size > 0) {

                $next = ceil($download_size / 100);

            }

            $this->nextFeedbackTracker = $this->nextFeedbackTracker + $next;

        }

        elseif ($downloaded_size > $this->nextFeedbackTracker) {

            $this->remote_url_event_callback(array(

                "progress" => array(

                    "loaded" => $downloaded_size,

                    "total" => $download_size,

                    "rowId" => $this->rowId,

                    )

                ));



            // stop loads of loops

            $this->nextFeedbackTracker = $this->nextFeedbackTracker + UploaderHelper::REMOTE_URL_UPLOAD_FEEDBACK_CHUNKS_BYTES;

        }

    }



    public function moveIntoStorage($fileUpload, $tmpFile, $keepOriginal = false) {

        if ($fileUpload->name[0] === '.') {

            $fileUpload->name = substr($fileUpload->name, 1);

        }

        $fileUpload->name = trim($fileUpload->name);

        if (strlen($fileUpload->name) == 0) {

            $fileUpload->name = date('Ymdhi');

        }

        $parts = explode(".", $fileUpload->name);

        $lastPart = end($parts);

        $extension = strtolower($lastPart);



        // figure out upload type

        $file_size = 0;



        // store the actual file

        $rs = $this->_storeFile($fileUpload, $tmpFile, $keepOriginal);

        $file_size = $rs['file_size'];

        $file_path = $rs['file_path'];

        $uploadServerId = $rs['uploadServerId'];

        $fileUpload = $rs['fileUpload'];

        $newFilename = $rs['newFilename'];

        $fileHash = $rs['fileHash'];



        // reset the connection to the database so mysql doesn't time out

        $db = Database::getDatabase(true);

        $db->close();

        $db = Database::getDatabase(true);



        // check filesize uploaded matches tmp uploaded

        if (($file_size == $fileUpload->size) && (!$fileUpload->error)) {

            $fileUpload->url = $this->options['upload_url'] . rawurlencode($fileUpload->name);



            // insert into the db

            $fileUpload->size = $file_size;

            $fileUpload->delete_url = '~d?' . $this->options['delete_hash'];

            $fileUpload->info_url = '~i?' . $this->options['delete_hash'];

            $fileUpload->delete_type = 'DELETE';

            $fileUpload->delete_hash = $this->options['delete_hash'];



            // create delete hash, make sure it's unique

            $deleteHash = md5($fileUpload->name . CoreHelper::getUsersIPAddress() . microtime());



            // get database connection

            $db = Database::getDatabase(true);



            // setup folder id for file

            $folderId = null;

            if (((int) $this->options['folder_id'] > 0) && ((int) $this->options['user_id'] > 0)) {

                // make sure the current user owns the folder or has been shared it with upload rights

                $validFolder = $db->getRow('SELECT userId '

                        . 'FROM file_folder '

                        . 'WHERE id=' . (int) $this->options['folder_id'] . ' '

                        . 'AND (userId = ' . (int) $this->options['user_id'] . ' '

                        . 'OR id IN (SELECT folder_id FROM file_folder_share LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id WHERE folder_id = ' . (int) $this->options['folder_id'] . ' '

                        . 'AND (shared_with_user_id = ' . (int) $this->options['uploaded_user_id'] . ' OR (shared_with_user_id IS NULL AND is_global = 1)) '

                        . 'AND share_permission_level IN ("upload_download", "all"))) '

                        . 'LIMIT 1');

                if ($validFolder) {

                    $folderId = (int) $this->options['folder_id'];



                    // set user_id to the owner of the folder, this is needed so internal sharing works as expected

                    $this->options['user_id'] = (int) $validFolder['userId'];

                }

            }

            if ((int) $folderId == 0) {

                $folderId = null;

            }



            // make sure the original filename is unique in the selected folder

            $originalFilename = $fileUpload->name;

            if ((int) $this->options['user_id'] > 0) {

                $foundExistingFile = 1;

                $tracker = 2;

                while ($foundExistingFile >= 1) {

                    $foundExistingFile = (int) $db->getValue('SELECT COUNT(id) '

                            . 'FROM file '

                            . 'WHERE originalFilename = ' . $db->quote($originalFilename) . ' '

                            . 'AND status = "active" '

                            . 'AND userId = ' . (int) $this->options['user_id'] . ' '

                            . 'AND folderId ' . ($folderId === NULL ? 'IS NULL' : ('= ' . $folderId)));

                    if ($foundExistingFile >= 1) {

                        $originalFilename = substr($fileUpload->name, 0, strlen($fileUpload->name) - strlen($extension) - 1) . ' (' . $tracker . ').' . $extension;

                        $tracker++;

                    }

                }

            }

            $fileUpload->name = FileHelper::makeFilenameSafe($originalFilename);

            $fileUpload->hash = md5_file($tmpFile);



            if (UploaderHelper::checkBannedFiles($fileUpload->hash, $fileUpload->size)) {

                $fileUpload->error = TranslateHelper::t('classuploader_file_is_banned', 'File is banned from being uploaded to this website.');

            }



            if (!$fileUpload->error) {

                // store in db

                $file = File::create();

                $file->originalFilename = $fileUpload->name;

                $file->shortUrl = 'temp';

                $file->fileType = $fileUpload->type;

                $file->extension = strtolower($extension);

                $file->fileSize = $fileUpload->size;

                $file->localFilePath = (substr($file_path, 0, strlen($this->options['upload_dir'])) == $this->options['upload_dir']) ? substr($file_path, strlen($this->options['upload_dir'])) : $file_path;



                // add user id if user is logged in

                $file->userId = $this->options['user_id'];

                $file->uploadedUserId = $this->options['uploaded_user_id'];

                $file->totalDownload = 0;

                $file->uploadedIP = CoreHelper::getUsersIPAddress();

                $file->uploadedDate = CoreHelper::sqlDateTime();

                $file->status = "active";

                $file->deleteHash = $deleteHash;

                $file->serverId = $uploadServerId;

                $file->fileHash = $fileHash;

                $file->adminNotes = '';

                $file->folderId = $folderId;

                $file->uploadSource = $this->options['upload_source'];

                $file->keywords = substr(implode(',', FileHelper::getKeywordArrFromString($originalFilename)), 0, 255);

                $file->unique_hash = FileHelper::createUniqueFileHashString();



                if (!$file->save()) {

                    $fileUpload->error = TranslateHelper::t('classuploader_failed_adding_to_database', 'Failed adding to database. [[[ERROR_MSG]]]', array(

                        'ERROR_MSG' => $file->errorMsg,

                        ));

                }

                else {

                    // create short url

                    $tracker = 1;

                    $shortUrl = FileHelper::createShortUrlPart($tracker . $file->id);

                    $fileTmp = File::loadOneByShortUrl($shortUrl);

                    while ($fileTmp) {

                        $shortUrl = FileHelper::createShortUrlPart($tracker . $file->id);

                        $fileTmp = File::loadOneByShortUrl($shortUrl);

                        $tracker++;

                    }



                    // update short url

                    $file->shortUrl = $shortUrl;

                    $file->save();



                    // update fileUpload with file location

                    $fileUpload->url = $file->getFullShortUrl();

                    $fileUpload->delete_url = $file->getDeleteUrl();

                    $fileUpload->info_url = $file->getInfoUrl();

                    $fileUpload->stats_url = $file->getStatisticsUrl();

                    $fileUpload->delete_hash = $file->deleteHash;

                    $fileUpload->short_url = $shortUrl;

                    $fileUpload->file_id = $file->id;

                    $fileUpload->unique_hash = $file->unique_hash;



                    // update storage stats

                    FileHelper::updateFileServerStorageStats();



                    // update total folder filesize

                    if ((int) $folderId > 0) {

                        FileFolderHelper::updateFolderFilesize((int) $folderId);

                    }



                    // call plugin hooks

                    $params = PluginHelper::callHook('uploaderSuccess', array(

                        'file' => $file,

                        'tmpFile' => $tmpFile,

                    ));

                }

            }

        }

        else if ($this->options['discard_aborted_uploads']) {

            //@TODO - make ftp compatible

            @unlink($file_path);

            @unlink($tmpFile);

            if (!isset($fileUpload->error)) {

                $fileUpload->error = TranslateHelper::t('classuploader_general_upload_error', 'General upload error, please contact support. Expected size: [[[FILE_SIZE]]]. Received size: [[[FILE_UPLOAD_SIZE]]].', array('FILE_SIZE' => $file_size, 'FILE_UPLOAD_SIZE' => $fileUpload->size));

            }

        }



        return $fileUpload;

    }



    public function _storeFile($fileUpload, $tmpFile, $keepOriginal = false) {

        // setup new filename

        $newFilename = md5(microtime());



        // refresh db connection

        $db = Database::getDatabase(true);

        $db->close();

        $db = Database::getDatabase(true);



        // select server from pool

        // if this is a 'direct' server, use it

        $uploadServerId = null;

        $uploadServerDetails = FileHelper::getCurrentServerDetails();

        if ($uploadServerDetails['serverType'] == 'direct' || $uploadServerDetails['serverType'] == 'local') {

            // direct server

            $uploadServerId = $uploadServerDetails['id'];

        }



        // failed loading a server id so far, try from server pool

        if ($uploadServerId === null) {

            // select server from pool

            $uploadServerId = FileServerHelper::getAvailableServerId();

        }



        // try to load the server details

        $uploadServerDetails = $db->getRow('SELECT * FROM file_server WHERE id = ' . (int) $uploadServerId);

        if (!$uploadServerDetails) {

            // if we failed to load any server, fallback on the current server

            $uploadServerDetails = FileHelper::getCurrentServerDetails();

            $uploadServerId = $uploadServerDetails['id'];

        }



        // override storage path

        if (strlen($uploadServerDetails['storagePath'])) {

            $this->options['upload_dir'] = $uploadServerDetails['storagePath'];

            if (substr($this->options['upload_dir'], strlen($this->options['upload_dir']) - 1, 1) == '/') {

                $this->options['upload_dir'] = substr($this->options['upload_dir'], 0, strlen($this->options['upload_dir']) - 1);

            }

            $this->options['upload_dir'] .= '/';

        }



        // create file hash

        $fileHash = md5_file($tmpFile);



        // check if the file hash already exists

        $fileExists = false;

        if ($fileUpload->size > 0) {

            $findFile = $db->getRow("SELECT * "

                    . "FROM file "

                    . "WHERE fileHash = :fileHash "

                    . "AND status = 'active' "

                    . "AND fileSize = :fileSize "

                    . "LIMIT 1", array(

                        'fileHash' => $fileHash,

                        'fileSize' => (int) $fileUpload->size,

                    ));

            if (COUNT($findFile) > 1) {

                $fileExists = true;

            }

        }



        if ($fileExists == false) {

            // include any plugins for other storage methods

            $params = PluginHelper::includeAppends('class_uploader_move_into_storage.inc.php', array(

                'actioned' => false,

                'file_path' => '',

                'uploadServerDetails' => $uploadServerDetails,

                'fileUpload' => $fileUpload,

                'newFilename' => $newFilename,

                'tmpFile' => $tmpFile,

                'uploader' => $this,

                ));

            if ($params['actioned'] == true) {

                $fileUpload = $params['fileUpload'];

                $filePath = $params['file_path'];

                $fileSize = $params['file_size'];

            }

            // local, direct or ftp storage methods

            else {

                // move remotely via ftp

                if ($uploadServerDetails['serverType'] == 'ftp') {

                    // connect ftp

                    $conn_id = ftp_connect($uploadServerDetails['ipAddress'], $uploadServerDetails['ftpPort'], 30);

                    if ($conn_id === false) {

                        $fileUpload->error = TranslateHelper::t('classuploader_could_not_connect_file_server', 'Could not connect to file server [[[IP_ADDRESS]]]', array('IP_ADDRESS' => $uploadServerDetails['ipAddress']));

                    }



                    // authenticate

                    if (!$fileUpload->error) {

                        $login_result = ftp_login($conn_id, $uploadServerDetails['ftpUsername'], $uploadServerDetails['ftpPassword']);

                        if ($login_result === false) {

                            $fileUpload->error = TranslateHelper::t('classuploader_could_not_authenticate_with_file_server', 'Could not authenticate with file server [[[IP_ADDRESS]]]', array('IP_ADDRESS' => $uploadServerDetails['ipAddress']));

                        }

                    }



                    // create the upload folder

                    if (!$fileUpload->error) {

                        $uploadPathDir = $this->options['upload_dir'] . substr($newFilename, 0, 2);

                        if (!ftp_mkdir($conn_id, $uploadPathDir)) {

                            // Error reporting removed for now as it causes issues with existing folders. Need to add a check in before here

                            // to see if the folder exists, then create if not.

                            // $fileUpload->error = 'There was a problem creating the storage folder on '.$uploadServerDetails['ipAddress'];

                        }

                    }



                    // upload via ftp

                    if (!$fileUpload->error) {

                        $filePath = $uploadPathDir . '/' . $newFilename;

                        clearstatcache();

                        if ($tmpFile) {

                            $serverConfigArr = '';

                            if (strlen($uploadServerDetails['serverConfig'])) {

                                $serverConfig = json_decode($uploadServerDetails['serverConfig'], true);

                                if (is_array($serverConfig)) {

                                    $serverConfigArr = $serverConfig;

                                }

                            }



                            if ((isset($serverConfigArr['ftp_passive_mode'])) && ($serverConfigArr['ftp_passive_mode'] == 'yes')) {

                                // enable passive mode

                                ftp_pasv($conn_id, true);

                            }



                            // initiate ftp

                            $ret = ftp_nb_put($conn_id, $filePath, $tmpFile, FTP_BINARY, FTP_AUTORESUME);

                            while ($ret == FTP_MOREDATA) {

                                // continue uploading

                                $ret = ftp_nb_continue($conn_id);

                            }



                            if ($ret != FTP_FINISHED) {

                                $fileUpload->error = TranslateHelper::t('classuploader_there_was_problem_uploading_file', 'There was a problem uploading the file to [[[IP_ADDRESS]]]', array('IP_ADDRESS' => $uploadServerDetails['ipAddress']));

                            }

                            else {

                                $fileSize = filesize($tmpFile);

                                if ($keepOriginal == false) {

                                    @unlink($tmpFile);

                                }

                            }

                        }

                    }



                    // close ftp connection

                    ftp_close($conn_id);

                }

                elseif (substr($uploadServerDetails['serverType'], 0, 10) == 'flysystem_') {

                    $filesystem = FileServerContainerHelper::init($uploadServerDetails['id']);

                    if (!$filesystem) {

                        $fileUpload->error = TranslateHelper::t('classuploader_could_not_setup_adapter', 'Could not setup adapter to upload file.');

                    }



                    if (!$fileUpload->error) {

                        $uploadPathDir = substr($newFilename, 0, 2);

                        $filePath = $uploadPathDir . '/' . $newFilename;



                        // upload the file

                        try {

                            // upload file

                            $stream = fopen($tmpFile, 'r+');

                            $rs = $filesystem->writeStream($filePath, $stream);

                            if (!$rs) {

                                $fileUpload->error = 'Could not upload file. Please contact support or try again.';

                            }

                            else {

                                $fileSize = filesize($tmpFile);

                                if ($keepOriginal == false) {

                                    @unlink($tmpFile);

                                }

                            }

                        }

                        catch (Exception $e) {

                            $fileUpload->error = $e->getMessage();

                        }

                    }

                }

                // move into local storage

                else {

                    // check the upload folder

                    if (($uploadServerDetails['serverType'] == 'direct') || (!file_exists($this->options['upload_dir']))) {

                        $this->options['upload_dir'] = DOC_ROOT . '/' . $this->options['upload_dir'];

                    }



                    // fallback

                    if (!file_exists($this->options['upload_dir'])) {

                        $this->options['upload_dir'] = FileServerHelper::getCurrentServerFileStoragePath();

                    }



                    // create the upload folder

                    $uploadPathDir = $this->options['upload_dir'] . substr($newFilename, 0, 2);

                    @mkdir($uploadPathDir);

                    @chmod($uploadPathDir, 0777);



                    $filePath = $uploadPathDir . '/' . $newFilename;

                    clearstatcache();

                    $rs = false;

                    if ($tmpFile) {

                        if ($keepOriginal == true) {

                            $rs = copy($tmpFile, $filePath);

                        }

                        else {

                            $rs = rename($tmpFile, $filePath);

                        }

                        if ($rs) {

                            @chmod($filePath, 0777);

                        }

                    }



                    if ($rs == false) {

                        $fileUpload->error = TranslateHelper::t('classuploader_could_not_move_file_into_storage_on_x', 'Could not move the file into storage on [[[SERVER]]], possibly a permissions issue with the file storage directory.', array('SERVER' => _CONFIG_SITE_HOST_URL)) . ' - ' . $tmpFile . ' - ' . $filePath;

                    }

                    $fileSize = filesize($filePath);

                }

            }

        }

        else {

            $fileSize = $findFile['fileSize'];

            $filePath = $this->options['upload_dir'] . $findFile['localFilePath'];

            $uploadServerId = $findFile['serverId'];

        }



        $rs = array();

        $rs['file_size'] = $fileSize;

        $rs['file_path'] = $filePath;

        $rs['uploadServerId'] = $uploadServerId;

        $rs['fileUpload'] = $fileUpload;

        $rs['newFilename'] = $newFilename;

        $rs['relative_file_path'] = (substr($filePath, 0, strlen($this->options['upload_dir'])) == $this->options['upload_dir']) ? substr($filePath, strlen($this->options['upload_dir'])) : $filePath;

        $rs['fileHash'] = $fileHash;



        return $rs;

    }



    /*

     * Removes any old files left over from failed chunked uploads

     */



    private function cleanLeftOverChunks() {

        // loop local tmp folder and clear any older than 3 days old

        $localTempStore = UploaderHelper::getLocalTempStorePath();

        foreach (glob($localTempStore . "*") as $file) {

            // protect the filename

            if (filemtime($file) < time() - 60 * 60 * 24 * 3) {

                // double check we're in the file store

                if (substr($file, 0, strlen(FileServerHelper::getCurrentServerFileStoragePath())) == FileServerHelper::getCurrentServerFileStoragePath()) {

                    @unlink($file);

                }

            }

        }

    }



    protected function getServerVar($id) {

        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';

    }



}

