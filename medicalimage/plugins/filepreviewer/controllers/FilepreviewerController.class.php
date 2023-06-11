<?php



namespace Plugins\Filepreviewer\Controllers;



use App\Core\BaseController;

use App\Core\Database;

use App\Models\File;

use App\Models\User;

use App\Helpers\AuthHelper;

use App\Helpers\CacheHelper;

use App\Helpers\CoreHelper;

use App\Helpers\FileHelper;

use App\Helpers\PluginHelper;



class FilepreviewerController extends BaseController

{



    public function directFile($shortUrl, $fileName = null) {

        // try to load the file object

        $file = null;

        if ($shortUrl) {

            $file = File::loadOneByShortUrl($shortUrl);

        }


        // load file details

        if (!$file) {

            // no file found

            return $this->render404();

        }



        // file must be active

        if ($file->status != 'active') {

            return $this->render404();

        }



        // check if file needs a password

        $folder = null;

        $Auth = AuthHelper::getAuth();

        if ($Auth->id != $file->userId) {

            if ($file->folderId !== null) {

                $folder = $file->getFolderData();

            }



            if (($folder) && (strlen($folder->accessPassword) > 0)) {

                // see if we have it in the session already

                $askPassword = true;

                if (!isset($_SESSION['folderPassword'])) {

                    $_SESSION['folderPassword'] = array();

                }

                elseif (isset($_SESSION['folderPassword'][$folder->id])) {

                    if ($_SESSION['folderPassword'][$folder->id] == $folder->accessPassword) {

                        $askPassword = false;

                    }

                }



                if ($askPassword) {

                    // redirect to main page which requests for a password

                    return $this->redirect(FileHelper::getFileUrl($file->id));

                }

            }

        }



        // check file permissions, allow owners, non user uploads and admin/mods

        if ($file->userId != null) {

            if ((($file->userId != $Auth->id) && ($Auth->level_id < 10))) {

                // if this is a private file

                if (CoreHelper::getOverallPublicStatus($file->userId, $file->folderId, $file->id) == false) {

                    $errorMsg = TranslateHelper::t("error_file_is_not_publicly_shared", "File is not publicly available.");

                    return $this->redirect(CoreHelper::getCoreSitePath() . "/error?e=" . urlencode($errorMsg));

                }

            }

        }


        // get download token and force download

        return $this->redirect($file->generateDirectDownloadUrlForMedia());

    }



    /**

     * This function gets hit when the cached version of the resized

     * image does not exist. It simply redirects to the PHP script which generates

     * it

     * 

     * @return type

     */

    public function resizeImage($fileId, $fileHash, $width, $height, $method, $extension) {

        // load file based on hash

        $file = File::loadOneByClause('unique_hash = :unique_hash '

                . 'AND id = :id', array(

                    'unique_hash' => $fileHash,

                    'id' => $fileId,

        ));

        if (!$file) {

            return $this->render404();

        }



        // constants

        define('MAX_SIZE_NO_WATERMARK', 201);



        // validation

        $fileId = (int) $fileId;

        $width = (int) $width;

        $height = (int) $height;

        if (($method != 'padded') && ($method != 'middle') && ($method != 'maximum')) {

            $method = 'cropped';

        }



        // support only jpg or gif output

        if ($extension != 'gif') {

            $extension = 'jpg';

        }



        // validate width & height

        if ($width <= 0) {

            $width = 8;

        }

        if ($height <= 0) {

            $height = 8;

        }

        

        // load plugin details

        $pluginObj = PluginHelper::getInstance('filepreviewer');



        // memory saver

        if (($width > 1100) || ($height > 1100)) {

            // fail

            return $this->redirect($pluginObj->getDefaultImageWebPath());

        }



        // try to load the file object

        $file = null;

        if ($fileId) {

            $file = File::loadOneById($fileId);

        }



        // load file details

        if (!$file) {

            // fail

            return $this->redirect($pluginObj->getDefaultImageWebPath());

        }



        // make sure it's an image

        if (!$file->isImage()) {

            // fail

            return $this->redirect($pluginObj->getDefaultImageWebPath());

        }



        // check if file needs a password. Disabled due to the new hashing method

        // in the cache url

        $folder = null;

        if ($file->folderId !== null) {

            $folder = $file->getFolderData();

        }

        

        /*

        if ($Auth->id != $file->userId) {

            if (($folder) && (strlen($folder->accessPassword) > 0)) {

                // see if we have it in the session already

                $askPassword = true;

                if (!isset($_SESSION['folderPassword'])) {

                    $_SESSION['folderPassword'] = array();

                }

                elseif (isset($_SESSION['folderPassword'][$folder->id])) {

                    if ($_SESSION['folderPassword'][$folder->id] == $folder->accessPassword) {

                        $askPassword = false;

                    }

                }



                if ($askPassword) {

                    // redirect to main page which requests for a password

                    return $this->redirect(FileHelper::getFileUrl($file->id));

                }

            }

        }

         * 

         */



        // check and show cache before loading environment

        $cacheFilePath = '../../../cache/plugins/filepreviewer/';

        $cacheFilePath .= $fileId . '/';

        $cacheFilePath .= str_replace(array('.', '/'), '', $fileHash) . '/';

        if (!file_exists($cacheFilePath)) {

            mkdir($cacheFilePath, 0777, true);

        }

        $cacheFileName = (int) $width . 'x' . (int) $height . '_' . $method . '.' . $extension;

        $fullCachePath = $cacheFilePath . $cacheFileName;



        // check for cache

        if (!CacheHelper::checkCacheFileExists($fullCachePath)) {

            // load content from main image

            $contents = '';

            $imageExtension = $file->extension;



            // figure out if we're resizing to animated or static

            $animated = false;

            if ((in_array($file->extension, $pluginObj->getAnimatedFileExtensions())) && ((($width >= $pluginObj->getHoldingCacheSize()) || ($height >= $pluginObj->getHoldingCacheSize()))) && ($extension == 'gif')) {

                $animated = true;

            }



            // create holding cache, if it doesn't already exist

            $pluginObj->setupImageMetaAndCache($file);



            // ignore for animated file types, i.e. use the original image

            if ((in_array($file->extension, $pluginObj->getAnimatedFileExtensions()) == false) && ($file->extension != 'png')) {

                if (($width <= $pluginObj->getHoldingCacheSize()) && ($height <= $pluginObj->getHoldingCacheSize())) {

                    $contents = $pluginObj->getHoldingCache($file);

                    if ($contents) {

                        $imageExtension = $extension;

                    }

                }

            }



            if (!strlen($contents)) {

                // use original image

                $contents = $file->download(false);

            }



            // if this is an animated gif just output it

            if ($animated == true) {

                return $this->renderFileContent($contents, array(

                    'Expires' => '0',

                    'Pragma' => 'public',

                    'Content-Type' => 'image/'.$extension,

                        ));

            }



            // load image 

            require_once(CORE_FRAMEWORK_LIBRARIES_ROOT . '/image_resizer/CustomSimpleImage.php');

            $img = new \CustomSimpleImage();

            $rs = $img->load_from_image_content($contents);

            if (!$rs) {

                // fail

                return $this->redirect($pluginObj->getDefaultImageWebPath());

            }



            if ($method == 'middle') {

                $img->thumbnail($width, $height);

            }

            elseif ($method == 'padded') {

                $img->padded_image($width, $height);

            }

            elseif ($method == 'cropped') {

                $img->best_fit($width, $height);

            }

            else {

                $img->resize($width, $height);

            }



            // add on the watermark after resizing & if this isn't a thumbnail

            if ($folder) {

                if (($width >= MAX_SIZE_NO_WATERMARK) || ($height >= MAX_SIZE_NO_WATERMARK)) {

                    $watermarkCachePath = CACHE_DIRECTORY_ROOT . '/user/' . (int) $folder->userId . '/watermark/watermark_original.png';

                    if (((bool) $folder->watermarkPreviews == true) && (file_exists($watermarkCachePath))) {

                        // load user

                        if ((int) $file->userId) {

                            $user = User::loadOneById((int) $file->userId);

                            if ($user) {

                                // apply watermark

                                $watermarkPadding = $user->getProfileValue('watermarkPadding') ? $user->getProfileValue('watermarkPadding') : 0;

                                $watermarkPosition = $user->getProfileValue('watermarkPosition') ? $user->getProfileValue('watermarkPosition') : 'bottom right';

                                $img->apply_watermark($watermarkCachePath, $watermarkPosition, $watermarkPadding, '1.0');

                            }

                        }

                    }

                }

            }



            $rs = false;



            // save image

            ob_start();

            $img->output($extension, $pluginObj->getThumbnailImageQuality());

            $imageContent = ob_get_clean();

            $rs = CacheHelper::saveCacheToFile('plugins/filepreviewer/' . $fileId . '/' . ($fileHash != null ? ($fileHash . '/') : '') . $cacheFileName, $imageContent);



            if (!$rs) {

                // failed saving cache (or caching disabled), just output

                $img->output($extension, $pluginObj->getThumbnailImageQuality());



                exit;

            }



            // tidy up

            if ($pluginObj->getImageLibrary() != 'gd') {

                @unlink($tmpImageFile);

            }

        }



        $size = $width . 'x' . $height;

        $filename = $file->originalFilename;

        $filename = str_replace(array('.' . $file->extension), "", $filename);

        $filename .= '_' . $size;

        $filename .= '.' . $file->extension;

        $filename = str_replace("\"", "", $filename);



        // output some headers

        header("Expires: 0");

        header("Pragma: public");

        header("Content-Type: image/" . $extension);

        

        return $this->renderFileContent(CacheHelper::getCacheFromFile('plugins/filepreviewer/' . $fileId . '/' . ($fileHash != null ? ($fileHash . '/') : '') . $cacheFileName), array(

                    'Expires' => '0',

                    'Pragma' => 'public',

                    'Content-Type' => 'image/'.$extension,

                        ));

    }



    public function pdfThumbnail($fileId, $width, $height, $method, $md5PluginSettings) {

        // load reward details

        $pluginConfig = PluginHelper::pluginSpecificConfiguration('filepreviewer');

        $pluginSettings = json_decode($pluginConfig['data']['plugin_settings'], true);



        // validation

        $fileId = (int) $fileId;

        $width = (int) $width;

        $height = (int) $height;

        if (($method != 'padded') && ($method != 'middle')) {

            $method = 'cropped';

        }



        // prep fallback urls

        $fallbackImageLargeUrl = FileHelper::getIconPreviewImageUrlLarge(array('extension' => 'pdf'), true, false);

        $fallbackImageUrl = FileHelper::getIconPreviewImageUrl(array('extension' => 'pdf'), true, 512);



        // validate width & height

        if (($width == 0) || ($height == 0)) {

            return $this->redirect($fallbackImageLargeUrl);

        }



        // memory saver

        if (($width > 5000) || ($height > 5000)) {

            return $this->redirect($fallbackImageLargeUrl);

        }



        // check the pdf option is enabled

        if ((int) $pluginSettings['pdf_thumbnails'] == 0) {

            // failed reading image

            if (($width > 160) || ($height > 160)) {

                return $this->redirect($fallbackImageUrl);

            }

            else {

                return $this->redirect($fallbackImageLargeUrl);

            }

        }



        // check for imagick

        if (!class_exists("imagick")) {

            // failed reading image

            if (($width > 160) || ($height > 160)) {

                return $this->redirect($fallbackImageUrl);

            }

            else {

                return $this->redirect($fallbackImageLargeUrl);

            }

        }



        // try to load the file object

        $file = null;

        if ($fileId) {

            $file = File::loadOneById($fileId);

        }



        // load file details

        if (!$file) {

            // no file found

            return $this->redirect($fallbackImageLargeUrl);

        }



        // cache paths

        $cacheFilePath = CACHE_DIRECTORY_ROOT . '/plugins/filepreviewer/' . (int) $file->id . '/pdf/';

        $fullCachePath = null;

        if (!is_dir($cacheFilePath)) {

            @mkdir($cacheFilePath, 0777, true);

        }



        // create original image if we need to

        $originalCacheFileName = 'original_image.jpg';

        $originalCachePath = $cacheFilePath . $originalCacheFileName;

        if (!file_exists($originalCachePath)) {

            // get original pdf file

            if ($file->serverId == FileHelper::getCurrentServerId()) {

                // local so use path

                $filePath = $file->getFullFilePath();

                $filePath .= '[0]';

            }

            else {

                // remote to use url

                $filePath = $file->generateDirectDownloadUrlForMedia();

            }



            // create and save screenshot of first page from pdf

            $im = new \imagick();

            $im->setResolution(200, 200);

            $im->readImage($filePath);

            $im->setimageformat("jpg");

            $im->flattenImages();

            $im->setImageAlphaChannel(\Imagick::VIRTUALPIXELMETHOD_WHITE);

            $im->writeimage($originalCachePath);

            $im->clear();

            $im->destroy();



            // try old method

            if (!file_exists($originalCachePath)) {

                $im = new \imagick();

                $im->setResolution(200, 200);

                $im->readImage($filePath . '[0]');

                $im->setimageformat("jpg");

                $im->flattenImages();

                $im->setImageAlphaChannel(\Imagick::VIRTUALPIXELMETHOD_WHITE);

                $im->writeimage($originalCachePath);

                $im->clear();

                $im->destroy();

            }

        }



        // make sure we have the original screenshot file

        if (!file_exists($originalCachePath)) {

            // failed reading image

            if (($width > 160) || ($height > 160)) {

                return $this->redirect($fallbackImageUrl);

            }

            else {

                return $this->redirect($fallbackImageLargeUrl);

            }

        }



        // create resized version

        $cacheFileName = (int) $width . 'x' . (int) $height . '_' . $method . '_' . md5(json_encode($pluginSettings)) . '.jpg';

        $fullCachePath = $cacheFilePath . $cacheFileName;



        // check for cache

        if (($fullCachePath == null) || (!file_exists($fullCachePath))) {

            header('Content-Type: image/jpeg');



            // load into memory

            $im = imagecreatefromjpeg($originalCachePath);

            if ($im === false) {

                // failed reading image

                if (($width > 160) || ($height > 160)) {

                    return $this->redirect($fallbackImageUrl);

                }

                else {

                    return $this->redirect($fallbackImageLargeUrl);

                }

            }



            // get image size

            $imageWidth = imagesx($im);

            $imageHeight = imagesy($im);



            $newwidth = (int) $width;

            $newheight = ($imageHeight / $imageWidth) * $newwidth;

            if ($newwidth > $imageWidth) {

                $newwidth = $imageWidth;

            }

            if ($newheight > $imageHeight) {

                $newheight = $imageHeight;

            }

            $tmp = imagecreatetruecolor($newwidth, $newheight);

            $tmpH = imagesy($tmp);



            // check height max

            if ($tmpH > (int) $height) {

                $newheight = (int) $height;

                $newwidth = ($imageWidth / $imageHeight) * $newheight;

                $tmp = imagecreatetruecolor($newwidth, $newheight);

            }



            // override method for small images

            if ($method == 'middle') {

                if ($width > $imageWidth) {

                    $method = 'padded';

                }

                elseif ($height > $imageHeight) {

                    $method = 'padded';

                }

            }



            if ($method == 'middle') {

                $tmp = imagecreatetruecolor($width, $height);



                $newwidth = (int) $width;

                $newheight = ($imageHeight / $imageWidth) * $newwidth;

                $destX = 0;

                $destY = 0;

                if ($newwidth > $imageWidth) {

                    $newwidth = $imageWidth;

                }

                if ($newheight > $imageHeight) {

                    $newheight = $imageHeight;

                }



                // calculate new x/y positions

                if ($newwidth > $width) {

                    $destX = floor(($width - $newwidth) / 2);

                }

                if ($newheight > $height) {

                    //$destY = floor(($height-$newheight)/2);

                    $destY = 0;

                }



                imagecopyresampled($tmp, $im, $destX, $destY, 0, 0, $newwidth, $newheight, $imageWidth, $imageHeight);

            }

            else {

                // this line actually does the image resizing, copying from the original

                // image into the $tmp image

                imagecopyresampled($tmp, $im, 0, 0, 0, 0, $newwidth, $newheight, $imageWidth, $imageHeight);

            }



            // add white padding

            if ($method == 'padded') {

                $w = $width;

                if ($w > $imageWidth) {

                    $w = $imageWidth;

                }

                $h = $height;

                if ($h > $imageHeight) {

                    $h = $imageHeight;

                }



                // create base image

                $bgImg = imagecreatetruecolor((int) $w, (int) $h);



                // set background white

                $background = imagecolorallocate($bgImg, 255, 255, 255);  // white

                //$background = imagecolorallocate($bgImg, 0, 0, 0);  // black



                imagefill($bgImg, 0, 0, $background);



                // add on the resized image

                imagecopyresampled($bgImg, $tmp, ((int) $w / 2) - ($newwidth / 2), ((int) $h / 2) - ($newheight / 2), 0, 0, $newwidth, $newheight, $newwidth, $newheight);



                // reassign variable so the image is output below

                imagedestroy($tmp);

                $tmp = $bgImg;

            }



            $rs = false;

            if ($fullCachePath != null) {

                // save image

                $rs = imagejpeg($tmp, $fullCachePath, 90);

            }



            if (!$rs) {

                // failed saving cache (or caching disabled), just output

                header('Content-Type: image/jpeg');

                imagejpeg($tmp, null, 90);

                exit;

            }



            // cleanup memory

            imagedestroy($tmp);

        }



        return $this->renderFileContent($fullCachePath, array(

                    'Content-Type' => 'image/jpeg',

                        )

        );

    }



}

