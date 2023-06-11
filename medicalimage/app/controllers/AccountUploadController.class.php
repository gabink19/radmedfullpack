<?php

namespace App\Controllers;

use App\Core\Database;
use App\Helpers\AuthHelper;
use App\Helpers\CrossSiteActionHelper;
use App\Helpers\FileHelper;
use App\Helpers\TranslateHelper;

class AccountUploadController extends AccountController
{

    public function ajaxUploader() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get the current logged in user
        $Auth = AuthHelper::getAuth();

        // pickup request for later
        $request = $this->getRequest();
        $db = Database::getDatabase();

        $fid = null;
        if ($request->request->has('fid')) {
            $fid = (int) $request->request->get('fid');
        }

        // prep params
        $templateParams = $this->getFileManagerTemplateParams();
        $templateParams = array_merge(array(
            'fid' => $fid,
            'uploadAction' => CrossSiteActionHelper::appendUrl(FileHelper::getUploadUrl() . '/ajax/file_upload_handler?r=' . htmlspecialchars(_CONFIG_SITE_HOST_URL) . '&p=' . htmlspecialchars(_CONFIG_SITE_PROTOCOL)),
                ), $templateParams);

        // load template
        return $this->render('account/ajax/uploader.html', $templateParams);
    }

    public function uploaderJs() {
        // get params for later
        $Auth = $this->getAuth();

        // pickup request for later
        $request = $this->getRequest();
        $db = Database::getDatabase();

        // for js translations (doesn't output anything, just ensures they're created)
        TranslateHelper::getTranslation('uploader_hour', 'hour');
        TranslateHelper::getTranslation('uploader_hours', 'hours');
        TranslateHelper::getTranslation('uploader_minute', 'minute');
        TranslateHelper::getTranslation('uploader_minutes', 'minutes');
        TranslateHelper::getTranslation('uploader_second', 'second');
        TranslateHelper::getTranslation('uploader_seconds', 'seconds');
        TranslateHelper::getTranslation('selected', 'selected');
        TranslateHelper::getTranslation('selected_image_clear', 'clear');
        TranslateHelper::getTranslation('account_file_details_clear_selected', 'Clear Selected');

        $fid = null;
        if ($request->request->has('fid')) {
            $fid = (int) $request->request->get('fid');
        }

        // prep params
        $templateParams = $this->getFileManagerTemplateParams();
        $templateParams = array_merge(array(
            'chunkedUploadSize' => 100000000,
            'fid' => $fid,
            'maxConcurrentThumbnailRequests' => 5,
            'uploadAction' => CrossSiteActionHelper::appendUrl(FileHelper::getUploadUrl() . '/ajax/file_upload_handler?r=' . htmlspecialchars(_CONFIG_SITE_HOST_URL) . '&p=' . htmlspecialchars(_CONFIG_SITE_PROTOCOL)),
            'urlUploadAction' => CrossSiteActionHelper::appendUrl(FileHelper::getUploadUrl() . '/ajax/url_upload_handler'),
            'backgroundUrlDownloading' => (SITE_CONFIG_REMOTE_URL_DOWNLOAD_IN_BACKGROUND==='yes' && $Auth->loggedIn() === true),
                ), $templateParams);

        // return rendered javascript
        $response = $this->render('account/partial/_uploader_javascript.html.twig', $templateParams);
        $response->headers->set('Content-Type', 'text/javascript');

        return $response;
    }
}
