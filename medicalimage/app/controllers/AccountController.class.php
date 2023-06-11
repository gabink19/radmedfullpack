<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\File;
use App\Models\FileFolder;
use App\Helpers\CoreHelper;
use App\Helpers\FileHelper;
use App\Helpers\FileFolderHelper;
use App\Helpers\FileManagerHelper;
use App\Helpers\UserHelper;
use App\Helpers\TranslateHelper;
use App\Helpers\StatsHelper;

class AccountController extends BaseController
{

    public function index($initialFileId = null) {
        
        // pickup request
        $request = $this->getRequest();

        // page OG info (for facebook)
        if ($initialFileId !== null) {
            $file = File::loadOneById($initialFileId);
            if ($file) {
                define("PAGE_OG_TITLE", substr(UCWords(TranslateHelper::t('View', 'view')) . ' ' . $file->originalFilename . ' ' . TranslateHelper::t('on', 'on') . ' ' . SITE_CONFIG_SITE_NAME, 0, 150));
                define("PAGE_OG_SITE_NAME", SITE_CONFIG_SITE_NAME);

                // don't show thumbnail if the album is private or has a password
                if ((int) $file->folderId) {
                    // check for password
                    $folderPassword = null;
                    $folder = FileFolder::loadOneById($file->folderId);
                    if ($folder) {
                        $folderPassword = $folder->accessPassword;
                    }

                    // check for privacy
                    $public = true;
                    if (((int) $folder->userId > 0) && ($folder->userId != $Auth->id)) {
                        if (CoreHelper::getOverallPublicStatus($folder->userId, $folder->id) == false) {
                            $public = false;
                        }
                    }
                    if (($public == true) && ($folderPassword != true)) {
                        define("PAGE_OG_IMAGE", FileHelper::getIconPreviewImageUrl((array) $file, false, 64, false, 280, 280, 'middle'));
                    }
                }
            }
        }
        else {
            // require user login
            if (($response = $this->requireLogin()) !== false) {
                return $response;
            }
        }

        // page OG info (for facebook)
        // @TODO - move to template
        define("PAGE_OG_TITLE", TranslateHelper::t("folder_page_name", "Folder"));
        define("PAGE_OG_SITE_NAME", SITE_CONFIG_SITE_NAME);
        define("PAGE_OG_DESCRIPTION", PAGE_DESCRIPTION);
        define("FROM_ACCOUNT_HOME", true);

        // get params for later
        $Auth = $this->getAuth();

        // prep params for template
        $templateParams = $this->getFileManagerTemplateParams();
        $templateParams = array_merge(array(
            'pageTitle' => TranslateHelper::t("loading", "Loading..."),
            'initialFileId' => $initialFileId!==null?(int)$initialFileId:null,
            'pageType' => 'folder',
            'totalActiveFiles' => isset($Auth->user)?$Auth->user->getTotalActiveFiles():0,
            'totalRootFiles' => isset($Auth->user)?(int) FileHelper::getTotalActiveFilesByUserFolderId($Auth->user->id, null):0,
            'totalSharedWithMeFiles' => isset($Auth->user)?$Auth->user->getTotalSharedWithMeFiles():0,
            'totalTrash' => isset($Auth->user)?$Auth->user->getTotalTrashFiles():0,
            'initialLoadFolderId' => -1,
                ), $templateParams);

        // load template
        return $this->render('account/index.html', $templateParams);
    }
    
    protected function getFileManagerTemplateParams() {
        // get params for later
        $Auth = $this->getAuth();

        // load folders
        $folderArr = array();
        if ($Auth->loggedIn()) {
            $folderArr = FileFolderHelper::loadAllActiveForSelect($Auth->user->id);
        }

        // figure out max files
        $maxFiles = UserHelper::getMaxUploadsAtOnce($Auth->package_id);

        // failsafe
        if ((int) $maxFiles == 0) {
            $maxFiles = 50;
        }

        // if php restrictions are lower than permitted, override
        $phpMaxSize = CoreHelper::getPHPMaxUpload();
        $maxUploadSizeNonChunking = 0;
        if ($phpMaxSize < $maxUploadSize) {
            $maxUploadSizeNonChunking = $phpMaxSize;
        }
        
        // load folder structure as array
        $folderListing = FileFolderHelper::loadAllActiveForSelect($Auth->id, '|||');
        $folderListingArr = array();
        foreach ($folderListing AS $k => $folderListingItem) {
            $folderListingArr[$k] = $folderListingItem;
        }

        return array(
            'Auth' => $Auth,
            'userAllowedToUpload' => UserHelper::getAllowedToUpload(),
            'userAllowedToRemoteUpload' => UserHelper::userTypeCanUseRemoteUrlUpload(),
            'maxUploadSize' => UserHelper::getMaxUploadFilesize(),
            'maxUploadSizeBoth' => CoreHelper::formatSize(UserHelper::getMaxUploadFilesize(), 'both'),
            'maxPermittedUrls' => (int) UserHelper::getMaxRemoteUrls(),
            'acceptedFileTypes' => UserHelper::getAcceptedFileTypes(),
            'acceptedFileTypesStr' => implode(', ', UserHelper::getAcceptedFileTypes()),
            'acceptedFileTypesUploaderStr' => str_replace('.', '', implode('|', UserHelper::getAcceptedFileTypes())),
            'folderArr' => $folderArr,
            'currentBrowserIsIE' => StatsHelper::currentBrowserIsIE(),
            'maxFiles' => $maxFiles,
            'maxUploadSizeNonChunking' => $maxUploadSizeNonChunking,
            'phpMaxSize' => $phpMaxSize,
            'orderByOptions' => FileManagerHelper::getFileBrowserSortingOptions(),
            'folderListingArr' => $folderListingArr,
            'sessionId' => session_id(),
            'cTracker' => md5(microtime()),
        );
    }
}
