<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\File;
use App\Models\FileFolder;
use App\Models\FileFolderShare;
use App\Models\User;
use App\Helpers\AuthHelper;
use App\Helpers\CacheHelper;
use App\Helpers\CoreHelper;
use App\Helpers\FileHelper;
use App\Helpers\FileFolderHelper;
use App\Helpers\FileManagerHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\PluginHelper;
use App\Helpers\UserHelper;
use App\Helpers\ThemeHelper;
use App\Helpers\TranslateHelper;
use App\Helpers\SharingHelper;
use App\Helpers\StatsHelper;
use App\Helpers\ValidationHelper;

class AccountFolderController extends AccountController
{

    public function viewFolder($folderUrlHash, $folderName = null) {
        // pickup request
        $request = $this->getRequest();
        $db = Database::getDatabase();

        // load folder
        $fileFolder = FileFolder::loadOne('urlHash', $folderUrlHash);
        if (!$fileFolder) {
            // support legacy folder urls (there were based on the folder id instead
            // of the urlHash)
            if(SITE_CONFIG_SUPPORT_LEGACY_FOLDER_URLS === 'Enabled') {
                $fileFolder = FileFolder::loadOne('id', $folderUrlHash);
            }
            
            if(!$fileFolder) {
                // no folder found
                return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
            }
        }

        // for inactive folders
        if ($fileFolder->status !== 'active') {
            // no folder found
            return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        // store 'sharekey' if we have it
        $isValid = false;
        if ($request->query->has('sharekey')) {
            // check if the key is valid
            $sharekey = trim($request->query->get('sharekey'));
            if (strlen($sharekey) === 64) {
                $isValid = $db->getValue('SELECT file_folder_share.id '
                        . 'FROM file_folder_share '
                        . 'LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id '
                        . 'WHERE access_key = ' . $db->quote($sharekey) . ' '
                        . 'AND folder_id = ' . (int) $fileFolder->id . ' '
                        . 'LIMIT 1');
                if ($isValid) {
                    $db->query('UPDATE file_folder_share '
                            . 'SET last_accessed = NOW() '
                            . 'WHERE id = ' . (int) $isValid . ' '
                            . 'LIMIT 1');
                    $_SESSION['sharekeyFolder' . $fileFolder->id] = true;
                }
            }
        }
        // clear it if we don't have it
        if ($isValid == false) {
            $_SESSION['sharekeyFolder' . $fileFolder->id] = false;
            unset($_SESSION['sharekeyFolder' . $fileFolder->id]);
        }
        if (isset($_GET['mobile']) && $_GET['mobile']=='true') {
            $_SESSION['mobile'] = 'true';
            if (!isset($_SESSION['folderPassword'])) {
                $_SESSION['folderPassword'] = array();
            }
            $_SESSION['folderPassword'][$fileFolder->id] = $fileFolder->accessPassword;
        }else{
            $_SESSION['mobile'] = 'false';
        }
        // load cover details for OG image
        $coverData = FileFolderHelper::getFolderCoverData($fileFolder->id);
        $coverId = (int) $coverData['file_id'];

        // page OG info (for facebook)
        define("PAGE_OG_TITLE", $fileFolder->folderName . ' ' . TranslateHelper::t("folder_page_name", "Folder"));
        define("PAGE_OG_SITE_NAME", SITE_CONFIG_SITE_NAME);
        define("PAGE_OG_DESCRIPTION", PAGE_DESCRIPTION);
        if ($coverId) {
            $file = File::loadOneById($coverId);
            if ($file) {
                define("PAGE_OG_TITLE", substr(UCWords(TranslateHelper::t('View', 'view')) . ' ' . $file->originalFilename . ' ' . TranslateHelper::t('on', 'on') . ' ' . SITE_CONFIG_SITE_NAME, 0, 150));
                define("PAGE_OG_SITE_NAME", SITE_CONFIG_SITE_NAME);

                // don't show thumbnail if the album is private or has a password
                if ((int) $file->folderId) {
                    // check for password
                    $folderPassword = $fileFolder->accessPassword;
                    // check for privacy
                    $public = true;
                    if (((int) $fileFolder->userId > 0) && ($fileFolder->userId != Auth . id)) {
                        if (CoreHelper::getOverallPublicStatus($fileFolder->userId, $fileFolder->id) == false) {
                            $public = false;
                        }
                    }
                    if (($public == true) && ($folderPassword != true)) {
                        define("PAGE_OG_IMAGE", FileHelper::getIconPreviewImageUrl((array) $file, false, 64, false, 280, 280, 'middle'));
                    }
                }
            }
        }

        // prep params for template
        $templateParams = $this->getFileManagerTemplateParams();
        $templateParams = array_merge(array(
            'pageTitle' => $fileFolder->folderName . ' ' . TranslateHelper::t("folder_page_name", "Folder"),
            'pageType' => 'folder',
            'initialLoadFolderId' => $fileFolder->id,
            'initialFileId' => null,
            'sharekeyOriginalUrl' => $_SESSION['sharekeyOriginalUrl'],
                ), $templateParams);
        // load template
        return $this->render('account/index.html', $templateParams);
    }

    public function nonFolderFileManagerPage() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // switch content depending on the route
        $pageType = '-1';
        switch ($this->getCurrentRoute()) {
            case '/account/shared_with_me':
                $pageType = 'shared';
                break;
            case '/account/recent':
                $pageType = 'recent';
                break;
            case '/account/all_files':
                $pageType = 'all';
                break;
            case '/account/trash':
                $pageType = 'trash';
                break;
        }

        // prep params for template
        $templateParams = $this->getFileManagerTemplateParams();
        $templateParams = array_merge(array(
            'pageType' => $pageType,
                ), $templateParams);

        // load template
        return $this->render('account/index.html', $templateParams);
    }

    public function ajaxAddEditFolder() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get the current logged in user
        $Auth = AuthHelper::getAuth();
        $db = Database::getDatabase();

        // pickup request for later
        $request = $this->getRequest();

        // load folder structure as array
        $folderListing = FileFolderHelper::loadAllActiveForSelect($Auth->id);

        // initial parent folder
        $parentId = '-1';
        if ($request->request->has('parentId')) {
            $parentId = (int) $request->request->get('parentId');
        }

        // defaults
        $isPublic = 1;
        $editFolderId = null;
        $folderName = '';
        $accessPassword = null;
        $watermarkPreviews = 0;
        $showDownloadLinks = 1;
        $folderUrl = '';
        if ($request->request->has('editFolderId')) {
            // load existing folder data
            $fileFolder = FileFolder::loadOneById((int) $request->request->get('editFolderId'));
            if ($fileFolder) {
                // check current user has permission to edit the fileFolder
                if ($fileFolder->userId === $Auth->id) {
                    // setup edit folder
                    $editFolderId = $fileFolder->id;
                    $folderName = $fileFolder->folderName;
                    $parentId = $fileFolder->parentId;
                    $isPublic = $fileFolder->isPublic;
                    $accessPassword = $fileFolder->accessPassword;
                    $watermarkPreviews = (int) $fileFolder->watermarkPreviews;
                    $showDownloadLinks = (int) $fileFolder->showDownloadLinks;
                    $folderUrl = $fileFolder->getFolderUrl();
                }
            }
        }

        $userIsPublic = 1;
        $folderIsPublic = 1;
        $globalPublic = 1;

        if (CoreHelper::getUserPublicStatus($Auth->id) === false) {
            $userIsPublic = 0;
        }

        if (CoreHelper::getUserFoldersPublicStatus($editFolderId) === false || CoreHelper::getUserFoldersPublicStatus($parentId) === false) {
            $folderIsPublic = 0;
        }

        if (CoreHelper::getOverallSitePrivacyStatus() === false) {
            $globalPublic = 0;
        }

        // load template
        return $this->render('account/ajax/add_edit_folder.html', array(
                    'editFolderId' => $editFolderId,
                    'folderName' => $folderName,
                    'parentId' => $parentId,
                    'isPublic' => $isPublic,
                    'accessPassword' => $accessPassword,
                    'watermarkPreviews' => $watermarkPreviews,
                    'showDownloadLinks' => $showDownloadLinks,
                    'folderListing' => $folderListing,
                    'userIsPublic' => $userIsPublic,
                    'folderIsPublic' => $folderIsPublic,
                    'globalPublic' => $globalPublic,
                    'folderUrl' => $folderUrl,
                    'currentFolderStr' => $editFolderId !== null ? $folderListing[$editFolderId] : '',
        ));
    }

    public function ajaxAddEditFolderProcess() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get the current logged in user
        $Auth = AuthHelper::getAuth();
        $db = Database::getDatabase();

        // pickup request for later
        $request = $this->getRequest();

        // load folder structure as array
        $folderListing = FileFolderHelper::loadAllActiveForSelect($Auth->id);

        // handle submission
        if ($request->request->has('submitme')) {
            // validation
            $folderName = trim($request->request->get('folderName'));
            $isPublic = (int) $request->request->get('isPublic');
            $enablePassword = false;
            if ($request->request->has('enablePassword')) {
                $enablePassword = true;
                $password = trim($request->request->get('password'));
            }
            $watermarkPreviews = (int) $request->request->get('watermarkPreviews');
            $showDownloadLinks = (int) $request->request->get('showDownloadLinks');

            $parentId = (int) $request->request->get('parentId');
            if (!strlen($folderName)) {
                NotificationHelper::setError(TranslateHelper::t("please_enter_the_foldername", "Please enter the folder name"));
            }
            elseif (CoreHelper::inDemoMode() == true) {
                NotificationHelper::setError(TranslateHelper::t("no_changes_in_demo_mode"));
            }
            else {
                $editFolderId = null;
                if ($request->request->has('editFolderId')) {
                    // load existing folder data
                    $fileFolder = FileFolder::loadOneById((int) $request->request->get('editFolderId'));
                    if ($fileFolder) {
                        // check current user has permission to edit the fileFolder
                        if ($fileFolder->userId == $Auth->id) {
                            // setup edit folder
                            $editFolderId = $fileFolder->id;
                        }
                    }
                }

                $extraClause = '';
                if ($editFolderId !== null) {
                    $extraClause = ' AND id != ' . (int) $editFolderId;
                }

                // check for existing folder
                $rs = $db->getRow('SELECT id '
                        . 'FROM file_folder '
                        . 'WHERE status = "active" '
                        . 'AND folderName = :folderName '
                        . 'AND parentId ' . ($parentId == '-1' ? ('IS NULL') : ('= ' . (int) $parentId)) . ' '
                        . 'AND userId = :userId' . $extraClause, array(
                    'folderName' => $folderName,
                    'userId' => $Auth->id,
                ));
                if ($rs) {
                    if (COUNT($rs)) {
                        NotificationHelper::setError(TranslateHelper::t("already_an_folder_with_that_name", "You already have an folder with that name, please use another"));
                    }
                }
            }

            // create the folder
            if (!NotificationHelper::isErrors()) {
                // make sure the user owns the parent folder to stop tampering
                if (!isset($folderListing[$parentId])) {
                    $parentId = 0;
                }

                if ($parentId == 0) {
                    $parentId = null;
                }

                // get database connection
                $db = Database::getDatabase();

                // update folder
                if ($editFolderId !== null) {
                    $fileFolder = FileFolder::loadOneById($editFolderId);
                }
                // add folder
                else {
                    $fileFolder = FileFolder::create();
                    
                    // the userId should always be the same as the parentId, unless in root
                    $folderUserId = $Auth->id;
                    if($parentId != null) {
                        $parentFolder = FileFolder::loadOneById($parentId);
                        if($parentFolder) {
                            $folderUserId = $parentFolder->userId;
                        }
                    }
                    $fileFolder->userId = $folderUserId;
                    $fileFolder->addedUserId = $Auth->id;
                    $fileFolder->urlHash = FileFolderHelper::generateRandomFolderHash();
                }

                $fileFolder->folderName = $folderName;
                $fileFolder->isPublic = $isPublic;
                $fileFolder->parentId = $parentId;
                $fileFolder->watermarkPreviews = $watermarkPreviews;
                $fileFolder->showDownloadLinks = $showDownloadLinks;

                // update password
                $passwordHash = '';
                if ($enablePassword == true) {
                    if ((strlen($password)) && ($password != '**********')) {
                        $passwordHash = md5($password);
                    }
                }
                else {
                    // remove existing password
                    $passwordHash = null;
                }
                if (($passwordHash === null) || (strlen($passwordHash))) {
                    $fileFolder->accessPassword = $passwordHash;
                }

                // save folder
                $fileFolder->save();

                // extra section for adds
                if ($editFolderId === null) {
                    // ensure we've setup the sharing permissions for the new folder
                    if ($parentId !== NULL) {
                        FileFolderHelper::copyPermissionsToNewFolder($parentId, $fileFolder->id);
                    }

                    // success message
                    NotificationHelper::setSuccess(TranslateHelper::t("folder_created", "Folder created."));
                    $editFolderId = $fileFolder->id;
                }
                else {
                    // if the watermark option has changed, ensure we remove any cached previews
                    if ((int) $fileFolder->watermarkPreviews != (int) $watermarkPreviews) {
                        $files = FileHelper::loadAllActiveByFolderId($editFolderId);
                        if ($files) {
                            $pluginObj = PluginHelper::getInstance('filepreviewer');
                            foreach ($files AS $file) {
                                $pluginObj->deleteImagePreviewCache($file['id']);
                            }
                        }
                    }

                    // success message
                    NotificationHelper::setSuccess(TranslateHelper::t("folder_updated", "Folder updated."));
                }
            }
        }

        // prepare result
        $returnJson = array();
        $returnJson['success'] = false;
        $returnJson['msg'] = TranslateHelper::t("problem_updating_folder", "There was a problem updating the folder, please try again later.");
        if (NotificationHelper::isErrors()) {
            // error
            $returnJson['success'] = false;
            $returnJson['msg'] = implode('<br/>', NotificationHelper::getErrors());
        }
        else {
            // success
            $returnJson['success'] = true;
            $returnJson['msg'] = implode('<br/>', NotificationHelper::getSuccess());
        }
        $returnJson['folder_id'] = $editFolderId;

        // rebuild folder html
        $folderArr = array();
        if ($Auth->loggedIn()) {
            // clear any cache to allow for the new folder
            CacheHelper::clearCache('FOLDER_ACTIVE_OBJECTS_BY_USERID_' . (int) $Auth->id);
            $folderArr = FileFolderHelper::loadAllActiveForSelect($Auth->id);
        }
        $returnJson['folder_listing_html'] = '<select id="upload_folder_id" name="upload_folder_id" class="form-control" ' . (!$Auth->loggedIn() ? 'DISABLED="DISABLED"' : '') . '>';
        $returnJson['folder_listing_html'] .= '	<option value="">' . (!$Auth->loggedIn() ? TranslateHelper::t("index_login_to_enable", "- login to enable -") : TranslateHelper::t("index_default", "- default -")) . '</option>';
        if (COUNT($folderArr)) {
            foreach ($folderArr AS $id => $folderLabel) {
                $returnJson['folder_listing_html'] .= '<option value="' . (int) $id . '"';
                if ($fid == (int) $id) {
                    $returnJson['folder_listing_html'] .= ' SELECTED';
                }
                $returnJson['folder_listing_html'] .= '>' . ValidationHelper::safeOutputToScreen($folderLabel) . '</option>';
            }
        }
        $returnJson['folder_listing_html'] .= '</select>';

        // output response
        return $this->renderJson($returnJson);
    }

    public function ajaxGenerateFolderSharingUrl() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get params for later
        $Auth = $this->getAuth();
        $db = Database::getDatabase();

        // prepare result
        $result = array();
        $result['error'] = true;
        $result['msg'] = 'Error generating url.';

        // get items and validate
        $safeItems = $this->getSafeFileFolderIdsFromRequest();
        if (!$safeItems) {
            NotificationHelper::setError(TranslateHelper::t("failed_loading_file_or_folder_ids", "Failed loading file or folders."));
        }
        else {
            $fileIds = $safeItems['fileIds'];
            $folderIds = $safeItems['folderIds'];
        }

        // create new share
        $fileFolderShare = SharingHelper::createShare($fileIds, $folderIds, null, 'view');

        include getcwd()."/plugins/phpqrcode/qrlib.php";
        $tempdir =  getcwd()."/plugins/phpqrcode/qrcode/"; //Nama folder tempat menyimpan file qrcode
         if (!file_exists($tempdir)) //Buat folder bername temp
            mkdir($tempdir);

            //isi qrcode jika di scan
            $codeContents = $fileFolderShare->getFullSharingUrl(); 
          
         //simpan file kedalam folder temp dengan nama 001.png
        if (!file_exists($tempdir.$fileFolderShare->id."_folder.png")){
            \QRcode::png($codeContents,$tempdir.$fileFolderShare->id."_folder.png"); 
        }
        $fileQRCode = $fileFolderShare->id."_folder.png";

        if ($fileFolderShare) {
            $result['error'] = false;
            $result['file'] = $fileQRCode;
            $result['msg'] = $fileFolderShare->getFullSharingUrl();
        }
        else {
            $result['error'] = true;
            $result['file'] = '';
            $result['msg'] = TranslateHelper::t('could_not_create_sharing_url', 'Could not create sharing url.');
        }

        return $this->renderJson($result);
    }

    public function ajaxShareFileFolder() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get the current logged in user
        $Auth = AuthHelper::getAuth();
        $db = Database::getDatabase();

        // pickup request for later
        $request = $this->getRequest();
        $safeItems = $this->getSafeFileFolderIdsFromRequest();
        if (!$safeItems) {
            return $this->render404();
        }

        $fileIds = $safeItems['fileIds'];
        $folderIds = $safeItems['folderIds'];

        // @TODO Lookup existing based on md5 hash of $fileIds & $folderIds
        // load template
        return $this->render('account/ajax/share_file_folder.html', array(
                    'fileIds' => $fileIds,
                    'folderIds' => $folderIds,
                    'fileCount' => count($fileIds),
                    'fileFolderCount' => count($folderIds),
                    'shareLink' => 'SHARE_LINK',
        ));
    }

    public function ajaxShareFileFolderInternally() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get the current logged in user
        $Auth = AuthHelper::getAuth();
        $db = Database::getDatabase();

        // pickup request for later
        $request = $this->getRequest();
        $safeItems = $this->getSafeFileFolderIdsFromRequest();
        if (!$safeItems) {
            return $this->render404();
        }

        $fileIds = $safeItems['fileIds'];
        $folderIds = $safeItems['folderIds'];
        $registeredEmailAddress = strtolower(trim($request->request->get('registeredEmailAddress')));
        $registeredEmailAddressExp = explode(',', $registeredEmailAddress);
        $permissionType = $request->request->get('permissionType');
        if (!in_array($permissionType, array('view', 'upload_download', 'all'))) {
            $permissionType = 'view';
        }

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = TranslateHelper::t('share_folder_internally_success', 'If the email address exists within our system, this folder will now be available to the user within their account.');

        if (strlen($registeredEmailAddress) == 0) {
            $result['error'] = true;
            $result['msg'] = TranslateHelper::t('please_enter_an_email_address_to_share_with', 'Please enter an existing account email address to share this folder with.');
        }

        if ($result['error'] === false) {
            // add user(s) to folder
            foreach ($registeredEmailAddressExp AS $registeredEmailAddressItem) {
                // lookup account based on email
                $user = User::loadOne('email', $registeredEmailAddressItem);
                if ($user) {
                    // make sure the user isn't adding themselves
                    if ($user->id === $Auth->id) {
                        continue;
                    }

                    // add the share
                    $fileFolderShare = SharingHelper::createShare($fileIds, $folderIds, $user->id, $permissionType);

                    // send email to the recipient
                    $subject = TranslateHelper::t('share_items_internally_subject', 'Some items have been shared with you on [[[SITE_NAME]]]', array('SITE_NAME' => SITE_CONFIG_SITE_NAME));

                    $replacements = array(
                        'FIRST_NAME' => $user->firstname,
                        'SITE_NAME' => SITE_CONFIG_SITE_NAME,
                        'WEB_ROOT' => WEB_ROOT,
                        'SHARE_URL' => $fileFolderShare->getFullSharingUrl(),
                    );
                    $defaultContent = "Dear [[[FIRST_NAME]]],<br/><br/>";
                    $defaultContent .= "Some items have been shared with you on [[[SITE_NAME]]]. Login to your account or click the unique url below to access the items.<br/><br/>";
                    $defaultContent .= "<strong>Url:</strong> <a href='[[[SHARE_URL]]]'>[[[SHARE_URL]]]</a><br/><br/>";
                    $defaultContent .= "Feel free to contact us if you need any support.<br/><br/>";
                    $defaultContent .= "Regards,<br/>";
                    $defaultContent .= "[[[SITE_NAME]]] Admin";
                    $htmlMsg = TranslateHelper::t('share_items_internally_content', $defaultContent, $replacements);

                    CoreHelper::sendHtmlEmail($user->email, $subject, $htmlMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, strip_tags(str_replace("<br/>", "\n", $htmlMsg)));
                }
            }
        }

        // output response
        return $this->renderJson($result);
    }

    private function getSafeFileFolderIdsFromRequest() {
        // prepare db connection
        $db = Database::getDatabase();
        $Auth = $this->getAuth();

        // pickup request
        $request = $this->getRequest();

        // get items and validate
        $fileIds = $request->request->has('fileIds') ? $request->request->get('fileIds') : array();
        $safeFileIds = array_map('intval', $fileIds);
        $folderIds = $request->request->has('folderIds') ? $request->request->get('folderIds') : array();
        $safeFolderIds = array_map('intval', $folderIds);

        // make sure we have some items
        if (count($fileIds) === 0 && count($folderIds) === 0) {
            // exit
            return false;
        }

        // validate ownership
        $fileCount = 0;
        if (count($safeFileIds)) {
            $fileCount = (int) $db->getValue('SELECT count(id) '
                            . 'FROM file '
                            . 'WHERE id IN (' . implode(',', $safeFileIds) . ') '
                            . 'AND userId = :user_id', array(
                        'user_id' => $Auth->id,
            ));
        }
        $fileFolderCount = 0;
        if (count($safeFolderIds)) {
            $fileFolderCount = (int) $db->getValue('SELECT count(id) '
                            . 'FROM file_folder '
                            . 'WHERE id IN (' . implode(',', $safeFolderIds) . ') '
                            . 'AND userId = :user_id', array(
                        'user_id' => $Auth->id,
            ));
        }
        if ((count($fileIds) !== $fileCount) || (count($folderIds) !== $fileFolderCount)) {
            // exit
            return false;
        }

        return array(
            'fileIds' => $safeFileIds,
            'folderIds' => $safeFolderIds,
        );
    }

    public function ajaxShareFileFolderInternallyExisting() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get params for later
        $Auth = $this->getAuth();
        $request = $this->getRequest();
        $db = Database::getDatabase();

        // get items and validate
        $safeItems = $this->getSafeFileFolderIdsFromRequest();
        if (!$safeItems) {
            NotificationHelper::setError(TranslateHelper::t("failed_loading_file_or_folder_ids", "Failed loading file or folders."));
        }
        else {
            $fileIds = $safeItems['fileIds'];
            $folderIds = $safeItems['folderIds'];
        }

        // get list of shares
        $sharedUsers = SharingHelper::getSharedUsersForFilesAndFolders($fileIds, $folderIds);

        // load template
        return $this->render('account/ajax/share_file_folder_internally_existing.html', array(
                    'folderShares' => $sharedUsers,
                    'fileIds' => $fileIds,
                    'folderIds' => $folderIds,
        ));
    }

    public function ajaxShareFileFolderInternallyRemove() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get params for later
        $Auth = $this->getAuth();

        // prepare result
        $result = array();

        // get request
        $request = $this->getRequest();
        $shareId = (int) $request->query->get('folderShareId');

        // prepare result
        $result = array();

        // load folder share
        $fileFolderShare = FileFolderShare::loadOneById($shareId);
        if (!$fileFolderShare) {
            $result['error'] = true;
            $result['msg'] = TranslateHelper::t('could_not_load_share', 'Could not load share for removal.');

            return $this->renderJson($result);
        }

        // check ownership
        if ($fileFolderShare->created_by_user_id != $Auth->id) {
            $result['error'] = true;
            $result['msg'] = TranslateHelper::t('could_not_load_share', 'Could not load share for removal.');

            return $this->renderJson($result);
        }

        // remove the share
        SharingHelper::removeShareById($fileFolderShare->id);

        // send the result
        $result['error'] = false;
        $result['msg'] = TranslateHelper::t('share_folder_internally_success_removed', 'Access to this folder by the selected user has been removed.');

        return $this->renderJson($result);
    }

    public function ajaxEmailFolderUrl() {
        // require user login
        if (($response = $this->requireLogin()) !== false) {
            return $response;
        }

        // get params for later
        $Auth = $this->getAuth();

        // get request
        $request = $this->getRequest();
        // echo "<pre>";print_r($request); echo "</pre>";die();
        $safeItems = $this->getSafeFileFolderIdsFromRequest();
        if (!$safeItems) {
            NotificationHelper::setError(TranslateHelper::t("failed_loading_file_or_folder_ids", "Failed loading file or folders."));
        }
        else {
            $fileIds = $safeItems['fileIds'];
            $folderIds = $safeItems['folderIds'];
            $shareEmailAddress = strip_tags(substr(strtolower(trim($request->request->get('shareEmailAddress'))), 0, 255));
            $shareExtraMessage = strip_tags(trim($request->request->get('shareExtraMessage')));
        }

        // validation
        if (strlen($shareEmailAddress) === 0) {
            NotificationHelper::setError(TranslateHelper::t("please_enter_the_recipient_email_address", "Please enter the recipient email address."));
        }
        elseif (ValidationHelper::validEmail($shareEmailAddress) == false) {
            NotificationHelper::setError(TranslateHelper::t("please_enter_a_valid_recipient_email_address", "Please enter a valid recipient email address."));
        }

        // send the email
        if (!NotificationHelper::isErrors()) {
            // add the share url
            $fileFolderShare = SharingHelper::createShare($fileIds, $folderIds, null, 'view');
            $shareEmailSharingUrl = $fileFolderShare->getFullSharingUrl();

            $fileFolderforurl = FileFolder::loadOneById($folderIds[0]);
            $newUrlShare = ThemeHelper::getLoadedInstance()->getAccountWebRoot().'/'.$fileFolderforurl->urlHash.'/'.$fileFolderforurl->folderName;
            $newUrlShare = str_replace('account', 'folder', $newUrlShare);
            // debug

            // setup shared by names
            $sharedBy = TranslateHelper::t('guest', 'Guest');
            $sharedByEmail = '';
            if ($Auth->loggedIn()) {
                $sharedBy = $Auth->getAccountScreenName();
                $sharedByEmail = $Auth->email;
            }

            // send the email
            $subject = TranslateHelper::t('email_items_url_process_subject', 'Items shared by [[[SHARED_BY_NAME]]] on [[[SITE_NAME]]]', array(
                        'SITE_NAME' => SITE_CONFIG_SITE_NAME,
                        'SHARED_BY_NAME' => $sharedBy,
                            )
            );
            $arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
            $tgl = explode('-', strip_tags(trim($request->request->get('shareCheckUpDate'))));
            $replacements = array(
                'SITE_NAME' => SITE_CONFIG_SITE_NAME,
                'WEB_ROOT' => ThemeHelper::getLoadedInstance()->getAccountWebRoot(),
                'SHARED_BY_NAME' => $sharedBy,
                'SHARED_EMAIL_ADDRESS' => $sharedByEmail,
                'EXTRA_MESSAGE' => strlen($shareExtraMessage) ? nl2br($shareExtraMessage) : TranslateHelper::t('not_applicable_short', 'n/a'),
                // 'SHARING_URL' => $shareEmailSharingUrl,
                'SHARING_URL' => $newUrlShare,
                'SHARING_RESULT' =>strip_tags(trim($request->request->get('shareResult'))),
                'SHARING_NAME' =>strip_tags(trim($request->request->get('shareName'))),
                'SHARING_CHECKUPDATE' =>$tgl[2]." ".$arrNamaBulan[$tgl[1]]." ".$tgl[0],
            );
            // $defaultContent = "[[[SHARED_BY_NAME]]] has shared the following items with you via <a href='[[[WEB_ROOT]]]'>[[[SITE_NAME]]]</a>:<br/><br/>";
            // $defaultContent .= "<strong>View:</strong> [[[SHARING_URL]]]<br/>";
            // $defaultContent .= "<strong>From:</strong> [[[SHARED_BY_NAME]]] [[[SHARED_EMAIL_ADDRESS]]]<br/>";
            // $defaultContent .= "<strong>Message:</strong><br/>[[[EXTRA_MESSAGE]]]<br/><br/>";
            // $defaultContent .= "Feel free to contact us if you have any difficulties viewing the items.<br/><br/>";
            // $defaultContent .= "Regards,<br/>";
            // $defaultContent .= "[[[SITE_NAME]]] Admin";

            // $defaultContent = "Yth [[[SHARING_NAME]]], <br/><br/><br/>";
            // $defaultContent .= "Berikut kami kirimkan Hasil Pemeriksaan Radiologi <strong>[[[SHARING_RESULT]]]</strong> atas nama <strong>[[[SHARING_NAME]]]</strong> yang telah dilakukan pada tanggal <strong>[[[SHARING_CHECKUPDATE]]]</strong>.<br/><br/><br/>";
            // $defaultContent .= "Hasil berupa gambar dan ekspertise dokter radiologi terlampir.<br/><br/>";
            // $defaultContent .= "<strong>Url:</strong> [[[SHARING_URL]]]<br/>";
            // $defaultContent .= "<br/><br/>Terimakasih atas perhatiannya";
            $tgl_inggris = date('Y-m-d', strtotime($request->request->get('shareCheckUpDate')));
            $defaultContent = '
            <table border="3">
            <tbody>
            <tr>
            <td>
            <p>Yth. <strong>[[[SHARING_NAME]]]</strong><strong>,</strong></p>
            <p>&nbsp;</p>
            <p>Terima kasih atas kepercayaan Anda kepada Rumah Sakit Brawijaya Saharjo. Terlampir adalah Hasil Pemeriksaan&nbsp;<strong>[[[SHARING_RESULT]]]</strong>&nbsp;atas nama<strong>&nbsp;[[[SHARING_NAME]]]&nbsp;</strong>yang telah dilakukan pada tanggal<strong>&nbsp;[[[SHARING_CHECKUPDATE]]]</strong>.</p>
            <p>Untuk memudahkan Anda, format BARU <em>password untuk melihat hasil pemeriksaan radiologi </em>Anda adalah <strong>DDMMYYYY</strong>. Silakan gunakan <em>password</em> sesuai petunjuk format di bawah ini untuk mengakses <em>hasil pemeriksaan </em>Anda.</p>
            <p>Format password hasil pemeriksaan radiologi baru Anda adalah DDMMYYYY, di mana:</p>
            <ul>
            <li><strong>DD</strong> : Dua digit tanggal lahir Anda, contoh: 01</li>
            <li><strong>MM</strong> : Dua digit bulan lahir Anda, contoh: 01</li>
            <li><strong>YYYY</strong> : Empat digit tahun kelahiran Anda, contoh: 1986</li>
            </ul>
            <p><em>Password hasil pemeriksaan radiologi </em>berdasarkan contoh di atas adalah: <strong>01011986</strong>.</p>
            <p>Hasil terlampir berupa gambar dan ekspertise dokter radiologi.</p>
            <p>&nbsp;</p>
            <p><strong>Url:</strong> <a href="[[[SHARING_URL]]]"><b>Klik Disini !</b></a></p>
            <p>&nbsp;</p>
            <p>Salam,</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <h3>Departemen Radiologi Rumah Sakit Brawijaya Saharjo</h3>
            </td>
            </tr>
            </tbody>
            </table>
            <p><span style="color: #000000; background-color: #999999;">RADIOLOGY DEPARTMENT BRAWIJAYA HOSPITAL SAHARJO Jl. Dr. Saharjo No.199, RW.1, tebet Bar., Kec. Tebet, Kota Jakarta Selatan, DKI Jakarta 12870 021- 3973-7890 0821-2221-1389 (Whats App Text Only) Pesan dikirim dariRadMED on '.date("d/m/Y H:i:s").'</span></p>
            <p>Jangan balas email ini, karena tidak dipantau secara aktif. Silakan ajukan pertanyaan, saran atau komentar ke website. Terima kasih atas ketertarikan Anda pada RS Brawijaya Saharjo. Kami senang memiliki kesempatan yang berkelanjutan untuk melayani Anda.</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>';

            $defaultContent .= '
            <table border="3">
            <tbody>
            <tr>
            <td>
            <p>Dear <strong>[[[SHARING_NAME]]],</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p>&nbsp;</p>
            <p>Thank you for your trust in Brawijaya Hospital Saharjo. Attached here with is the <strong>[[[SHARING_RESULT]]]</strong> exam result in the name of <strong>[[[SHARING_NAME]]]</strong> which was performed on <strong>'.date('F jS, Y', strtotime($tgl_inggris)).'.</strong></p>
            <p>For your convenience, the NEW password format for viewing your radiological exam results is <strong>DDMMYYYY</strong>. Please use the password according to the format instructions below to access your examination results.</p>
            <p>The password format for your new radiology exam is <strong>DDMMYYYY</strong>, where:</p>
            <ul>
            <li><strong>DD</strong> : two digits of your birth date, example: 01</li>
            <li><strong>MM</strong> : two digits of your birth month, example: 01</li>
            <li><strong>YYYY</strong> : four digits of your birth year, example: 1986</li>
            </ul>
            <p>&nbsp;</p>
            <p>The password for radiology exam based on the example above is: 01011986.</p>
            <p>The attached results are medical images and report of the examination.</p>
            <p><strong>Url:</strong> <a href="[[[SHARING_URL]]]"><b>Click Here !</b></a></p>
            <p>&nbsp;</p>
            <p>Best regards,</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <h3>Radiology Department Brawijaya Hospital Saharjo</h3>
            </td>
            </tr>
            </tbody>
            </table>
            <p><span style="color: #000000; background-color: #999999;">RADIOLOGY DEPARTMENT BRAWIJAYA HOSPITAL SAHARJO Jl. Dr. Saharjo No.199, RW.1, tebet Bar., Kec. Tebet, Kota Jakarta Selatan, DKI Jakarta 12870 021- 3973-7890 0821-2221-1389 (Whats App Text Only)
            Pesan dikirim dariRadMED on '.date("d/m/Y H:i:s").'
            </span></p>
            <p>Do not reply to this email, as it is not actively monitored. Please direct questions, suggestions or comments to website. Thank you for your interest in Brawijaya Saharjo Hospital. We are pleased to have the continued opportunity to serve you.</p>';

            $htmlMsg = TranslateHelper::t('email_items_url_process_contentv6', $defaultContent, $replacements);
            $subject = TranslateHelper::t('subject_konten', '[[[SHARING_NAME]]] - Hasil pemeriksaan/Examination Result [[[SHARING_RESULT]]]', $replacements);;
            // echo "<pre>";print_r($htmlMsg); echo "</pre>";die();

            CoreHelper::sendHtmlEmail($shareEmailAddress, $subject, $htmlMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, strip_tags(str_replace("<br/>", "\n", $htmlMsg)));
            NotificationHelper::setSuccess(TranslateHelper::t("email_share_url_process_folder_send_via_email_to", "Items shared via email to [[[RECIPIENT_EMAIL_ADDRESS]]]", array(
                        'RECIPIENT_EMAIL_ADDRESS' => $shareEmailAddress,
                            )
            ));
        }

        // prepare result
        $result = array();
        $result['success'] = false;
        $result['msg'] = TranslateHelper::t("problem_sending_email", "There was a problem sending the email, please try again later.");
        if (NotificationHelper::isErrors()) {
            // error
            $result['success'] = false;
            $result['msg'] = implode('<br/>', NotificationHelper::getErrors());
        }
        else {
            // success
            $result['success'] = true;
            $result['msg'] = implode('<br/>', NotificationHelper::getSuccess());
        }

        return $this->renderJson($result);
    }

    public function ajaxHomeV2FolderListing() {
        // pickup params
        $request = $this->getRequest();
        $folder = -1;
        if ($request->query->has('folder')) {
            $folder = $request->query->get('folder');
        }
        $Auth = $this->getAuth();
        $db = Database::getDatabase();

        // prepare clause for user owned folders
        $clause = '(userId = ' . (int) $Auth->id . ' AND file_folder.status = "active" AND ';
        $clause2 = '(file_folder.id IN (SELECT folder_id FROM file_folder_share LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id WHERE shared_with_user_id = ' . (int) $Auth->id . ') AND ';
        if ($folder != -1) {
            $clause .= 'parentId = ' . (int) $folder;
            $clause2 .= 'parentId = ' . (int) $folder;
        }
        else {
            $clause .= 'parentId IS NULL';

            // clause to add any shared folders
            $clause2 .= '(file_folder_share.shared_with_user_id = ' . (int) $Auth->id . ' '
                    . 'AND (file_folder.parentId NOT IN '
                    . '(SELECT folder_id FROM file_folder_share LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id WHERE shared_with_user_id = ' . (int) $Auth->id . ') '
                    . 'OR file_folder.parentId IS NULL)'
                    . ')';
        }
        $clause .= ')';
        $clause2 .= ')';

        $rs = array();

        // load folder data for user
        $rows = $db->getRows('SELECT file_folder.id, folderName, totalSize, users.username, file_folder.urlHash, '
                . '(SELECT COUNT(ffchild.id) AS total FROM file_folder ffchild WHERE ffchild.parentId = file_folder.id) AS childrenCount, '
                . 'accessPassword, (SELECT COUNT(file.id) AS total FROM file WHERE folderId = file_folder.id AND '
                . 'file.status = "active") AS fileCount '
                . 'FROM file_folder '
                . 'LEFT JOIN users ON file_folder.userId = users.id '
                . 'WHERE ' . $clause . ' '
                . 'ORDER BY folderName '
                . 'LIMIT 150');
        if ($rows) {
            foreach ($rows AS $row) {
                $folderType = 'folder';
                if (((int) $row['fileCount'] > 0) || ((int) $row['childrenCount'] > 0)) {
                    $folderType = 'folderfull';
                }

                if (strlen($row['accessPassword'])) {
                    $folderType = 'folderpassword';
                }

                if ($row['shared_with_user_id'] == $Auth->id) {
                    $folderType = 'foldershared';
                }

                $permission = 'all';
                $totalSize = $row['totalSize'];
                if ($totalSize === NULL) {
                    $totalSize = FileFolderHelper::updateFolderFilesize($row['id']);
                }

                if ((int) $row['childrenCount'] > 0) {
                    $rs[$row{'folderName'}] = array(
                        'data' => $row['folderName'] . (((int) $row['fileCount'] > 0) ? (' (' . number_format($row['fileCount']) . ')') : '') . ' ',
                        'attr' => array(
                            'id' => $row['id'],
                            'owner' => $row['username'],
                            'permission' => $permission,
                            'total_size' => CoreHelper::formatSize($totalSize),
                            'title' => TranslateHelper::t('account_home_folder_treeview_double_click', 'Double click to view/hide subfolders'),
                            'rel' => $folderType,
                            'pageType' => 'folder',
                        ),
                        'children' => array(
                            'state' => 'closed'
                        ),
                        'state' => 'closed'
                    );
                }
                else {
                    $rs[$row{'folderName'}] = array(
                        'data' => $row['folderName'] . (((int) $row['fileCount'] > 0) ? (' (' . number_format($row['fileCount']) . ')') : ''),
                        'attr' => array(
                            'id' => $row['id'],
                            'owner' => $row['username'],
                            'permission' => $permission,
                            'total_size' => CoreHelper::formatSize($totalSize),
                            'title' => '',
                            'rel' => $folderType,
                            'pageType' => 'folder',
                        )
                    );
                }
            }
        }

        // sort by keys to order folder listing
        uksort($rs, "strnatcasecmp");

        // remove keys as they cause issues with the treeview
        $rs = array_values($rs);

        return $this->renderJson($rs);
    }

    public function ajaxLoadFiles() {
        // pickup params
        $request = $this->getRequest();


        // setup session params
        if (!isset($_SESSION['search'])) {
            $_SESSION['search'] = array();
        }
        if (!isset($_SESSION['search']['perPage'])) {
            $_SESSION['search']['perPage'] = FileManagerHelper::getPerPageDefault();
        }
        if (!isset($_SESSION['search']['filterOrderBy'])) {
            $_SESSION['search']['filterOrderBy'] = FileManagerHelper::getSortingDefault();
        }
        if (!isset($_SESSION['browse']['viewType'])) {
            $_SESSION['browse']['viewType'] = 'fileManagerIcon';
            if (FileManagerHelper::getViewLayoutDefault() == 'list') {
                $_SESSION['browse']['viewType'] = 'fileManagerList';
            }
        }

        // pickup initial params
        $pageType = $request->request->get('pageType');
        $pageStart = $request->request->get('pageStart');
        $perPage = $request->request->get('perPage') > 0 ? $request->request->get('perPage') : $_SESSION['search']['perPage'];
        $filterOrderBy = strlen($request->request->get('filterOrderBy')) ? $request->request->get('filterOrderBy') : $_SESSION['search']['filterOrderBy'];

        // advanced filters
        $searchTerm = '';
        $filterUploadedDateRange = null;
        if($request->request->has('additionalParams')) {
            $additionalParams = $request->request->get('additionalParams');
            $searchTerm = isset($additionalParams['searchTerm'])?$additionalParams['searchTerm'] : '';
            $filterUploadedDateRange = (isset($additionalParams['filterUploadedDateRange']) && strlen($additionalParams['filterUploadedDateRange']))?$additionalParams['filterUploadedDateRange'] : '';
        }

        // setup our file manager class
        $fileManager = FileManagerHelper::init($pageType);
        if (!$fileManager) {
            return $this->render404();
        }
        // set parameters on object
        $fileManager->setParameters(array(
            'pageType' => $pageType,
            'nodeId' => $request->request->get('nodeId'),
            'pageStart' => $pageStart,
            'perPage' => $perPage,
            'filterOrderBy' => $filterOrderBy,
            'searchTerm' => $searchTerm,
            'filterUploadedDateRange' => $filterUploadedDateRange,
        ));

        // validate login, if required
        if ($fileManager->isCurrentUserAuthenticated() === false) {
            return $this->render404();
        }

        // get file manager html (returns an array with html and javascript items)
        // if (isset($_SESSION['mobile']) && $_SESSION['mobile']==true) {
        //     $returnJson = $fileManager->getFileManagerHtml(['cuan_cuan']);
        // }else{
            $returnJson = $fileManager->getFileManagerHtml();
        // }
        $returnJson['page_title'] = !isset($returnJson['page_title']) ? $fileManager->getPageTitle() : $returnJson['page_title'];
        $returnJson['page_url'] = !isset($returnJson['page_url']) ? $fileManager->getPageUrl() : $returnJson['page_url'];
        // output response
        return $this->renderJson($returnJson);
    }

}
