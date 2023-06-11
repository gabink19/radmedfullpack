<?php



namespace Plugins\Filepreviewer\Controllers;



use App\Core\BaseController;

use App\Helpers\CoreHelper;

use App\Helpers\FileHelper;

use App\Helpers\PluginHelper;

use App\Helpers\ThemeHelper;

use App\Models\File;

use App\Controllers\AccountController;



class HooksController extends BaseController

{



    public function fileDownloadBottom($params = null) {

        // check for file object

        if (!isset($params['file'])) {

            // if no file found, redirect to home page

            return $this->redirect(WEB_ROOT);

        }



        // handle download request so preview page shows instead

        // call AccountController which should handle selected file

        $accountController = new AccountController();



        return $accountController->index((int) $params['file']->id);

    }



    public function fileDownloadTop($params = null) {

        $request = $this->getRequest();

        if ($request->query->has('idt')) {

            return $this->fileDownloadBottom($params);

        }

    }



    public function fileRemoveFile($params = null) {

        $ext = FileHelper::getImageExtensionsArr();



        $file = $params['file'];

        if (in_array(strtolower($params['file']->extension), $ext)) {

            // load plugin details

            $pluginObj = PluginHelper::getInstance('filepreviewer');



            // queue cache for delete

            $pluginObj->deleteImageCache((int) $params['file']->id);

        }

    }



    public function uploaderSuccessResultHtml($params = null) {

        $fileUpload = $params['fileUpload'];

        $userFolders = $params['userFolders'];

        $uploadSource = $params['uploadSource'];

        $fileParts = explode(".", $fileUpload->name);

        $fileExtension = strtolower(end($fileParts));

        $previewImageUrlLarge = '';



        // only reformat for 'direct' uploads

        if ($uploadSource == 'direct') {

            // load file

            $file = File::loadOneByShortUrl($fileUpload->short_url);

            if ($file->isImage()) {

                // layout settings

                $thumbnailType = ThemeHelper::getConfigValue('thumbnail_type');



                $sizingMethod = 'middle';

                if ($thumbnailType == 'full') {

                    $sizingMethod = 'cropped';

                }

                $previewImageUrlLarge = FileHelper::getIconPreviewImageUrl((array) $file, false, 48, false, 160, 134, $sizingMethod);

            }



            $params['success_result_html'] = $previewImageUrlLarge;

        }

        else {

            // generate html

            $success_result_html = '';

            $success_result_html .= '<td class="cancel">';

            $success_result_html .= '   <img src="' . CoreHelper::getCoreSitePath() . '/themes/' . SITE_CONFIG_SITE_THEME . '/assets/images/green_tick_small.png" height="16" width="16" alt="success"/>';

            $success_result_html .= '</td>';

            $success_result_html .= '<td class="name">';

            $success_result_html .= $fileUpload->name;

            $success_result_html .= '</td>';

            $success_result_html .= '<td class="rightArrow"><img src="' . CoreHelper::getCoreSitePath() . '/themes/' . SITE_CONFIG_SITE_THEME . '/assets/images/blue_right_arrow.png" width="8" height="6" /></td>';

            $success_result_html .= '<td class="url urlOff">';

            $success_result_html .= '    <a href="' . $fileUpload->url . '" target="_blank">' . $fileUpload->url . '</a>';

            $success_result_html .= '    <div class="fileUrls hidden">' . $fileUpload->url . '</div>';

            $success_result_html .= '</td>';



            $params['success_result_html'] = $success_result_html;

        }



        return $params;

    }



    public function fileIconPreviewImageUrl($params = null) {



        $pluginObj = PluginHelper::getInstance('filepreviewer');

        $pluginDetails = PluginHelper::pluginSpecificConfiguration('filepreviewer');

        $pluginSettings = json_decode($pluginDetails['data']['plugin_settings'], true);



        // check this is an image

        $fileObj = File::hydrateSingleRecord($params['fileArr']);
        if ($fileObj->isImage()) {

            // only for active files

            if ($params['fileArr']['status'] == 'active') {

                $w = 99;

                if ((int) $params['width']) {

                    $w = (int) $params['width'];

                }



                $h = 60;

                if ((int) $params['height']) {

                    $h = (int) $params['height'];

                }



                // control for thumbnails

                $continue = true;

                if (($pluginSettings['preview_image_show_thumb'] == 0) && ($h <= 300)) {

                    $continue = false;

                }



                if ($continue == true) {

                    $m = 'middle';

                    if (trim($params['type'])) {

                        $m = trim($params['type']);

                    }



                    $o = 'jpg';

                    if (in_array($params['fileArr']['extension'], $pluginObj->getAnimatedFileExtensions())) {

                        $o = 'gif';

                    }



                    $params['iconUrl'] = $pluginObj->createImageCacheUrl($params['fileArr'], $w, $h, $m, $o);

                }

            }

        }

        // pdf

        elseif (in_array(strtolower($params['fileArr']['extension']), array('pdf'))) {

            // only for active files

            if (isset($params['fileArr']['status']) && ($params['fileArr']['status'] == 'active')) {

                // check for imagemagick

                if (($pluginSettings['preview_document_pdf_thumbs'] == 1) && (class_exists("imagick"))) {

                    $w = 99;

                    if ((int) $params['width']) {

                        $w = (int) $params['width'];

                    }



                    $h = 60;

                    if ((int) $params['height']) {

                        $h = (int) $params['height'];

                    }



                    $m = 'middle';



                    // url

                    $params['iconUrl'] = _CONFIG_SITE_PROTOCOL . '://' . FileHelper::getFileDomainAndPath($params['fileArr']['id'], $params['fileArr']['serverId'], true, true) . '/cache/plugins/filepreviewer/' . $params['fileArr']['id'] . '/pdf/' . $w . 'x' . $h . '_' . $m . '_' . md5(json_encode($pluginSettings)) . '.jpg';

                }

            }

        }


        // echo "<pre>";print_r($params); echo "</pre>";die();

        return $params;

    }



}

