<?php

namespace App\Controllers\admin;

use App\Controllers\admin\AdminBaseController;
use App\Core\Database;
use App\Models\PaymentLog;
use App\Models\User;
use App\Helpers\AdminHelper;
use App\Helpers\AuthHelper;
use App\Helpers\CoreHelper;
use App\Helpers\CacheHelper;
use App\Helpers\FileFolderHelper;
use App\Helpers\PluginHelper;
use App\Helpers\UserHelper;
use App\Helpers\ValidationHelper;
use App\Helpers\TranslateHelper;
use App\Services\Password;
use App\Services\PasswordPolicy;
use Spatie\Image\Image;

class UserController extends AdminBaseController
{

    public function userManage() {
        // admin only
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $Auth = AuthHelper::getAuth();

        // handle impersonate requests
        if ($request->query->has('impersonate')) {
            $impUserId = (int) $request->query->get('impersonate');
            if ($impUserId) {
                // load user
                $impUser = User::loadOneById($impUserId);
                if ($impUser) {
                    // make sure they are not an admin user for security purposes
                    $userType = UserHelper::getUserLevelValue('level_type', $impUser->level_id);
                    if ($userType != 'admin') {
                        // fine to impersonate user
                        $_SESSION['_old_user'] = $_SESSION['user'];
                        $rs = $Auth->impersonate($impUserId);
                        if ($rs) {
                            // redirect to customer file manager
                            return $this->redirect(WEB_ROOT . '/account');
                        }
                        else {
                            // failed impersonating user
                            unset($_SESSION['_old_user']);
                            $this->setError("Failed impersonating user account, please try again later.");
                        }
                    }
                }
            }
        }

        // account types
        $accountTypeDetails = $db->getRows('SELECT id, level_id, label '
                . 'FROM user_level '
                . 'WHERE id > 0 '
                . 'ORDER BY level_id ASC');

        // account status
        $accountStatusDetails = array(
            'active',
            'pending',
            'awaiting approval',
            'disabled',
            'suspended',
        );

        // error/success messages
        if ($request->query->has('sa')) {
            AdminHelper::setSuccess('New user successfully added.');
        }
        elseif ($request->query->has('se')) {
            AdminHelper::setSuccess('User successfully updated.');
        }
        elseif ($request->query->has('error')) {
            AdminHelper::setError(urldecode($request->query->get('error')));
        }

        // get any params
        $filterByAccountType = '';
        if ($request->query->has('filterByAccountType')) {
            $filterByAccountType = trim($request->query->get('filterByAccountType'));
        }

        $filterByAccountStatus = 'active';
        if ($request->query->has('filterByAccountStatus')) {
            $filterByAccountStatus = trim($request->query->get('filterByAccountStatus'));
        }

        $filterText = '';
        if ($request->query->has('filterText')) {
            $filterText = trim($request->query->get('filterText'));
        }

        $filterByAccountId = '';
        if ($request->query->has('filterByAccountId')) {
            $filterByAccountId = trim($request->query->get('filterByAccountId'));
        }

        // load template
        return $this->render('admin/user_manage.html', array_merge(array(
                    'accountTypeDetails' => $accountTypeDetails,
                    'accountStatusDetails' => $accountStatusDetails,
                    'filterByAccountType' => $filterByAccountType,
                    'filterByAccountStatus' => $filterByAccountStatus,
                    'filterText' => $filterText,
                    'filterByAccountId' => $filterByAccountId,
                                ), $this->getHeaderParams()));
    }

    public function ajaxUserManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;
        $filterByAccountType = strlen($request->query->get('filterByAccountType')) ? $request->query->get('filterByAccountType') : false;
        $filterByAccountStatus = strlen($request->query->get('filterByAccountStatus')) ? $request->query->get('filterByAccountStatus') : false;
        $filterByAccountId = (int) $request->query->get('filterByAccountId') ? (int) $request->query->get('filterByAccountId') : false;

        // account types
        $accountTypeDetailsLookup = array();
        $accountTypeDetails = $db->getRows('SELECT id, label, level_type '
                . 'FROM user_level '
                . 'ORDER BY id ASC');
        foreach ($accountTypeDetails AS $accountTypeDetail) {
            $accountTypeDetailsLookup[$accountTypeDetail{'id'}] = array('label' => $accountTypeDetail['label'], 'level_type' => $accountTypeDetail['level_type']);
        }

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'username';
        switch ($sortColumnName) {
            case 'username':
                $sort = 'username';
                break;
            case 'email_address':
                $sort = 'email';
                break;
            case 'account_type':
                $sort = 'level_id';
                break;
            case 'last_login':
                $sort = 'lastlogindate';
                break;
            case 'status':
                $sort = 'status';
                break;
            case 'space_used':
                $sort = '(SELECT SUM(fileSize) FROM file WHERE file.userId=users.id AND file.status="active")';
                break;
            case 'total_files':
                $sort = '(SELECT COUNT(id) FROM file WHERE file.userId=users.id AND file.status="active")';
                break;
        }

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= "AND (users.status = '" . $filterText . "' OR ";
            $sqlClause .= "users.username LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "users.email LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "users.firstname LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "users.lastname LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "users.id = '" . $filterText . "')";
        }

        if ($filterByAccountType) {
            $sqlClause .= " AND users.level_id = '" . $db->escape($filterByAccountType) . "'";
        }

        if ($filterByAccountStatus) {
            $sqlClause .= " AND users.status = '" . $db->escape($filterByAccountStatus) . "'";
        }

        if ($filterByAccountId) {
            $sqlClause .= " AND users.id = " . (int) $filterByAccountId;
        }

        $totalRS = $db->getValue("SELECT COUNT(users.id) AS total "
                . "FROM users " . $sqlClause);
        $limitedRS = $db->getRows("SELECT users.*, (SELECT SUM(fileSize) FROM file WHERE file.userId=users.id AND file.status='active') AS totalFileSize, "
                . "(SELECT COUNT(id) FROM file WHERE file.userId=users.id AND file.status='active') AS totalFiles "
                . "FROM users " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                // calculate css class to use for account type badge
                $cssClass = 'default';
                switch ($accountTypeDetailsLookup[$row{'level_id'}]['level_type']) {
                    case 'admin':
                        $cssClass = 'danger';
                        break;
                    case 'moderator':
                        $cssClass = 'warning';
                        break;
                    case 'paid':
                        $cssClass = 'primary';
                        break;
                    case 'free':
                        $cssClass = 'info';
                        break;
                }

                $accountLevelLabel = UCWords(AdminHelper::makeSafe($accountTypeDetailsLookup[$row{'level_id'}]['label']));
                $accountLevelHtml = '<span class="label label-' . $cssClass . '">' . $accountLevelLabel . '</span>';

                $lRow = array();

                // load avatar
                $avatarCachePath = 'user/' . (int) $row['id'] . '/profile';
                $avatarWidth = 44;
                $avatarHeight = 44;
                $avatarCacheFilename = MD5((int) $row['id'] . $avatarWidth . $avatarHeight . 'square') . '.jpg';
                $icon = CACHE_WEB_ROOT . '/' . $avatarCachePath . '/' . $avatarCacheFilename;
                if (!CacheHelper::checkCacheFileExists($avatarCachePath . '/' . $avatarCacheFilename)) {
                    // if one hasn't been uploaded
                    if (!CacheHelper::getCacheFromFile($avatarCachePath . '/avatar_original.jpg')) {
                        $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/avatar_default.jpg';
                    }
                    // if the user has uploaded one but the cache file just doesn't exist
                    else {
                        $icon = ADMIN_WEB_ROOT . '/ajax/account_view_avatar?userId=' . (int) $row['id'] . '&width=' . $avatarWidth . '&height=' . $avatarHeight;
                    }
                }

                $lRow[] = '<img src="' . $icon . '" width="16" height="16" class="avatar" title="User" alt="User"/>';
                $lRow[] = '<a href="user_edit/' . $row['id'] . '">' . AdminHelper::makeSafe($row['username']) . '</a>';
                $lRow[] = AdminHelper::makeSafe($row['email']);
                $lRow[] = $accountLevelHtml;
                $lRow[] = CoreHelper::formatDate($row['lastlogindate'], SITE_CONFIG_DATE_TIME_FORMAT);
                $lRow[] = (int) $row['totalFileSize'] > 0 ? AdminHelper::formatSize($row['totalFileSize']) : 0;
                $lRow[] = (int) $row['totalFiles'] > 0 ? ((int) $row['totalFiles'] . ' <a href="file_manage?fileByUser=' . $row['id'] . '"> <span class="fa fa-search" aria-hidden="true"></span></a>') : 0;
                $lRow[] = '<span class="statusText' . str_replace(" ", "", UCWords($row['status'])) . '">' . UCWords($row['status']) . '</span>';

                $links = array();
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="edit" href="user_edit/' . $row['id'] . '"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
                if ($row['status'] !== 'awaiting approval') {
                    $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="files" href="file_manage?filterByUser=' . $row['id'] . '"><span class="fa fa-upload" aria-hidden="true"></span></a>';
                }
                else {
                    $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="approve" href="#" onClick="confirmApproveUser(' . $row['id'] . '); return false;"><span class="fa fa-check text-success" aria-hidden="true"></span></a>';
                }
                if ((CoreHelper::formatDate($row['lastlogindate'], SITE_CONFIG_DATE_TIME_FORMAT) !== null) && ($row['status'] !== 'awaiting approval')) {
                    $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="login history" href="user_login_history?id=' . $row['id'] . '"><span class="fa fa-file-text-o" aria-hidden="true"></span></a>';
                }
                if ($Auth->id != $row['id']) {
                    if ($row['status'] !== 'awaiting approval') {
                        $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="delete user" href="#" onClick="confirmRemoveUser(' . $row['id'] . '); return false;"><span class="fa fa-trash text-danger" aria-hidden="true"></span></a>';
                        $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="impersonate user" href="#" onClick="confirmImpersonateUser(' . $row['id'] . '); return false;"><span class="fa fa-sign-in" aria-hidden="true"></span></a>';
                    }
                    else {
                        $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="decline" href="#" onClick="confirmDeclineUser(' . $row['id'] . '); return false;"><span class="fa fa-close text-danger" aria-hidden="true"></span></a>';
                    }
                }
                $lRow[] = '<div class="btn-group">' . implode(" ", $links) . '</div>';

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function userEdit($userId) {
        // admin only
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // load user details
        $user = User::loadOneById($userId);
        if (!$user) {
            return $this->redirect('user_manage?error=' . urlencode('There was a problem loading the user details.'));
        }
        $pageTitle = 'Edit User: \'' . $user->username . '\'';

        // account types
        $accountTypeDetails = $db->getRows('SELECT id, level_id, label '
                . 'FROM user_level '
                . 'WHERE id > 0 '
                . 'ORDER BY level_id ASC');

        // account status
        $accountStatusDetails = array(
            'active',
            'pending',
            'awaiting approval',
            'disabled',
            'suspended',
        );

        // user titles
        $titleItems = array(
            'Mr',
            'Ms',
            'Mrs',
            'Miss',
            'Miss',
            'Dr',
        );

        // load all file servers
        $sQL = "SELECT id, serverLabel "
                . "FROM file_server "
                . "ORDER BY serverLabel";
        $serverDetails = $db->getRows($sQL);

        // prepare variables
        $username = $user->username;
        $password = '';
        $confirm_password = '';
        $account_status = $user->status;
        $account_type = $user->level_id;
        $expiry_date = (strlen($user->paidExpiryDate) && ($user->paidExpiryDate != '0000-00-00 00:00:00')) ? date('d/m/Y', strtotime($user->paidExpiryDate)) : '';
        $title = $user->title;
        $first_name = $user->firstname;
        $last_name = $user->lastname;
        $email_address = $user->email;
        $storage_limit = $user->storageLimitOverride;
        $remainingBWDownload = $user->remainingBWDownload;
        $upload_server_override = $user->uploadServerOverride;

        // setup keys
        $key1 = '';
        $key2 = '';
        $accountAPIKeys = $db->getRow('SELECT key_public, key_secret '
                . 'FROM apiv2_api_key '
                . 'WHERE user_id = :user_id '
                . 'LIMIT 1', array(
            'user_id' => $user->id,
                )
        );
        if ($accountAPIKeys) {
            $key1 = $accountAPIKeys['key_public'];
            $key2 = $accountAPIKeys['key_secret'];
        }

        // handle page submissions
        if ($request->request->has('submitted')) {
            // get variables
            $user_password = trim($request->request->get('user_password'));
            $confirm_password = trim($request->request->get('confirm_password'));
            $account_status = trim($request->request->get('account_status'));
            $account_type = trim($request->request->get('account_type'));
            $expiry_date = trim($request->request->get('expiry_date'));
            $title = trim($request->request->get('title'));
            $first_name = trim($request->request->get('first_name'));
            $last_name = trim($request->request->get('last_name'));
            $email_address = trim(strtolower($request->request->get('email_address')));
            $storage_limit = trim($request->request->get('storage_limit'));
            $storage_limit = str_replace(array(',', ' ', '.', '(', ')', '-'), '', $storage_limit);
            $remainingBWDownload = trim($request->request->get('remainingBWDownload'));
            $remainingBWDownload = str_replace(array(',', ' ', '.', '(', ')', '-'), '', $remainingBWDownload);
            if ((int) $remainingBWDownload == 0) {
                $remainingBWDownload = null;
            }
            $dbExpiryDate = '';
            $upload_server_override = trim($request->request->get('upload_server_override'));
            $uploadedAvatar = null;
            if ($request->files->has('avatar') && !empty($request->files->get('avatar'))) {
                $uploadedAvatar = $request->files->get('avatar');
            }
            $removeAvatar = false;
            if ($request->request->has('removeAvatar') && ((int) $request->request->get('removeAvatar') == 1)) {
                $removeAvatar = true;
            }

            // pickup api keys
            $key1 = trim($request->request->get('key1'));
            $key2 = trim($request->request->get('key2'));

            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            elseif (strlen($first_name) == 0) {
                AdminHelper::setError(AdminHelper::t("enter_first_name"));
            }
            elseif (strlen($last_name) == 0) {
                AdminHelper::setError(AdminHelper::t("enter_last_name"));
            }
            elseif (strlen($email_address) == 0) {
                AdminHelper::setError(AdminHelper::t("enter_email_address"));
            }
            elseif (ValidationHelper::validEmail($email_address) == false) {
                AdminHelper::setError(AdminHelper::t("entered_email_address_invalid"));
            }
            elseif (strlen($expiry_date)) {
                // turn into db format
                $exp1 = explode(" ", $expiry_date);
                $exp = explode("/", $exp1[0]);
                if (COUNT($exp) != 3) {
                    AdminHelper::setError(AdminHelper::t("account_expiry_invalid_dd_mm_yy", "Account expiry date invalid, it should be in the format dd/mm/yyyy"));
                }
                else {
                    $dbExpiryDate = $exp[2] . '-' . $exp[1] . '-' . $exp[0] . ' 00:00:00';

                    // check format
                    if (strtotime($dbExpiryDate) == false) {
                        AdminHelper::setError(AdminHelper::t("account_expiry_invalid_dd_mm_yy", "Account expiry date invalid, it should be in the format dd/mm/yyyy"));
                    }
                }
            }

            // check for password
            if (AdminHelper::isErrors() == false) {
                if (strlen($user_password)) {
                    if ($user_password != $confirm_password) {
                        AdminHelper::setError(AdminHelper::t("confirmation_password_does_not_match", "Your confirmation password does not match"));
                    }
                    else {
                        // check password structure
                        $passValid = UserHelper::validatePassword($user_password);
                        if (is_array($passValid)) {
                            AdminHelper::setError(implode('<br/>', $passValid));
                        }
                    }
                }
            }

            if (AdminHelper::isErrors() == false) {
                if ($uploadedAvatar) {
                    // check filesize
                    $maxAvatarSize = 1024 * 1024 * 10;
                    if ($uploadedAvatar->getSize() > $maxAvatarSize) {
                        AdminHelper::setError(AdminHelper::t("account_edit_avatar_is_too_large", "The uploaded image can not be more than [[[MAX_SIZE_FORMATTED]]]", array('MAX_SIZE_FORMATTED' => CoreHelper::formatSize($maxAvatarSize))));
                    }
                    else {
                        // make sure it's an image
                        $imagesizedata = @getimagesize($uploadedAvatar->getPathName());
                        if ($imagesizedata === FALSE) {
                            //not image
                            AdminHelper::setError(AdminHelper::t("account_edit_avatar_is_not_an_image", "Your avatar must be a jpg, png or gif image."));
                        }
                    }
                }
            }

            if (AdminHelper::isErrors() == false) {
                if (strlen($key1) || strlen($key2)) {
                    // make sure keys are 64 characters in length
                    if ((strlen($key1) != 64) || (strlen($key2) != 64)) {
                        AdminHelper::setError(AdminHelper::t("account_api_keys_not_correct_length", "API keys should be 64 characters in length."));
                    }
                }
            }

            // add the account
            if (AdminHelper::isErrors() == false) {
                // update the user
                $user = User::loadOneById($userId);
                if (strlen($user_password)) {
                    $user->password = Password::createHash($user_password);
                }
                $user->level_id = $account_type;
                $user->email = $email_address;
                $user->status = $account_status;
                $user->title = $title;
                $user->firstname = $first_name;
                $user->lastname = $last_name;
                $user->paidExpiryDate = $dbExpiryDate;
                $user->storageLimitOverride = strlen($storage_limit) ? $storage_limit : NULL;
                $user->uploadServerOverride = (int) $upload_server_override ? (int) $upload_server_override : NULL;
                $user->remainingBWDownload = (int) $remainingBWDownload ? (int) $remainingBWDownload : NULL;
                $user->save();

                // remove existing
                if ($uploadedAvatar || $removeAvatar == true) {
                    $avatarCachePath = 'user/' . (int) $userId . '/profile';

                    // delete any existing avatar files including generate cache
                    if (file_exists(CACHE_DIRECTORY_ROOT . '/' . $avatarCachePath)) {
                        $files = CoreHelper::getDirectoryListing(CACHE_DIRECTORY_ROOT . '/' . $avatarCachePath);
                        if (COUNT($files)) {
                            foreach ($files AS $file) {
                                @unlink($file);
                            }
                        }
                    }
                }

                // save new avatar
                if ($uploadedAvatar) {
                    Image::load($uploadedAvatar->getPathName())
                            ->save(CACHE_DIRECTORY_ROOT . '/' . $avatarCachePath . '/avatar_original.png');
                }

                // update api keys
                $keepSame = $db->getValue('SELECT COUNT(id) AS total '
                        . 'FROM apiv2_api_key '
                        . 'WHERE key_public = :key_public '
                        . 'AND key_secret = :key_secret '
                        . 'AND user_id = :user_id '
                        . 'LIMIT 1', array(
                    'user_id' => (int) $userId,
                    'key_public' => $key1,
                    'key_secret' => $key2,
                ));
                if (!$keepSame) {
                    // delete any existing keys for the user
                    $db->query('DELETE FROM apiv2_api_key '
                            . 'WHERE user_id = :user_id '
                            . 'LIMIT 1', array(
                        'user_id' => (int) $userId,
                    ));

                    // add the new keys
                    if (strlen($key1) && strlen($key2)) {
                        $db->query('INSERT INTO apiv2_api_key (key_public, key_secret, user_id, date_created) '
                                . 'VALUES (:key_public, :key_secret, :user_id, NOW())', array(
                            'user_id' => (int) $userId,
                            'key_public' => $key1,
                            'key_secret' => $key2,
                        ));
                    }
                }

                // call plugin hooks
                PluginHelper::callHook('adminUserEdit');

                // redirect
                return $this->redirect(ADMIN_WEB_ROOT . '/user_manage?se=1');
            }
        }

        // check for existing avatar
        $hasAvatar = false;
        $avatarCachePath = 'user/' . (int) $user->id . '/profile/avatar_original.jpg';
        if (CacheHelper::checkCacheFileExists($avatarCachePath)) {
            $hasAvatar = true;
        }

        // load template
        return $this->render('admin/user_edit.html', array_merge(array(
                    'pageTitle' => $pageTitle,
                    'user' => $user,
                    'titleItems' => $titleItems,
                    'accountTypeDetails' => $accountTypeDetails,
                    'accountStatusDetails' => $accountStatusDetails,
                    'serverDetails' => $serverDetails,
                    'username' => $username,
                    'password' => $password,
                    'confirm_password' => $confirm_password,
                    'account_status' => $account_status,
                    'account_type' => $account_type,
                    'expiry_date' => $expiry_date,
                    'title' => $title,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email_address' => $email_address,
                    'storage_limit' => $storage_limit,
                    'remainingBWDownload' => $remainingBWDownload,
                    'upload_server_override' => $upload_server_override,
                    'key1' => $key1,
                    'key2' => $key2,
                    'hasAvatar' => $hasAvatar,
                    'defaultExpiryDate' => date('d/m/Y', strtotime('+1 year')),
                                ), $this->getHeaderParams()));
    }

    public function ajaxUserRemove() {
        // admin restrictions
        $this->restrictAdminAccess(10);

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $userId = (int) $request->request->get('userId');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // delete user
            $user = User::loadOneById($userId);
            if ($user) {
                $user->deleteUserData();
                $result['error'] = false;
                $result['msg'] = 'User \'' . $user->username . '\' and all associated data removed.';
            }
            else {
                $result['error'] = true;
                $result['msg'] = 'Could not find the user to delete.';
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxUserApprove() {
        // admin restrictions
        $this->restrictAdminAccess(10);

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $userId = (int) $request->request->get('userId');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // delete user
            $user = User::loadOneById($userId);
            if ($user) {
                $user->approveUser();
                $result['error'] = false;
                $result['msg'] = 'User \'' . $user->username . '\' approved. Email notification sent to \'' . $user->email . '\'.';
            }
            else {
                $result['error'] = true;
                $result['msg'] = 'Could not find the user to approve.';
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxUserDecline() {
        // admin restrictions
        $this->restrictAdminAccess(10);

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $userId = (int) $request->request->get('userId');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // delete user
            $user = User::loadOneById($userId);
            if ($user) {
                $user->declineUser();
                $result['error'] = false;
                $result['msg'] = 'User declined and removed. Email notification sent to the user.';
            }
            else {
                $result['error'] = true;
                $result['msg'] = 'Could not find the user to decline.';
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function userLoginHistory() {
        // admin only
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $Auth = AuthHelper::getAuth();

        // load user details
        $userId = (int) $request->query->get('id');
        $user = User::loadOneById($userId);
        if (!$user) {
            return $this->redirect('user_manage?error=' . urlencode('There was a problem loading the user details.'));
        }
        $pageTitle = '30 Day Login History for \'' . $user->username . '\'';

        // get all login data
        $loginData = $db->getRows('SELECT login_success.*, country_info.name AS country_name '
                . 'FROM login_success '
                . 'LEFT JOIN country_info ON login_success.country_code = country_info.iso_alpha2 '
                . 'WHERE login_success.user_id = ' . (int) $userId . ' '
                . 'ORDER BY date_added DESC');

        // get data for stats
        $totalDifferentIps = (int) $db->getValue('SELECT COUNT(DISTINCT ip_address) '
                        . 'FROM login_success '
                        . 'WHERE login_success.user_id = ' . (int) $userId);
        $totalDifferentCountries = (int) $db->getValue('SELECT COUNT(DISTINCT country_code) '
                        . 'FROM login_success '
                        . 'WHERE login_success.user_id = ' . (int) $userId);

        // load template
        return $this->render('admin/user_login_history.html', array_merge(array(
                    'userId' => $userId,
                    'pageTitle' => $pageTitle,
                    'loginData' => $loginData,
                    'totalDifferentIps' => $totalDifferentIps,
                    'totalDifferentCountries' => $totalDifferentCountries,
                                ), $this->getHeaderParams()));
    }

    public function userAdd() {
        // admin only
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // account types
        $accountTypeDetails = $db->getRows('SELECT id, level_id, label '
                . 'FROM user_level '
                . 'WHERE id > 0 '
                . 'ORDER BY level_id ASC');

        // account status
        $accountStatusDetails = array(
            'active',
            'pending',
            'awaiting approval',
            'disabled',
            'suspended',
        );

        // user titles
        $titleItems = array(
            'Mr',
            'Ms',
            'Mrs',
            'Miss',
            'Miss',
            'Dr',
        );

        // load all file servers
        $sQL = "SELECT id, serverLabel "
                . "FROM file_server "
                . "ORDER BY serverLabel";
        $serverDetails = $db->getRows($sQL);

        // prepare variables
        $username = '';
        $password = '';
        $confirm_password = '';
        $account_status = 'active';
        $account_type = 1;
        $expiry_date = '';
        $title = 'Mr';
        $first_name = '';
        $last_name = '';
        $email_address = '';
        $storage_limit = '';
        $remainingBWDownload = '';
        $upload_server_override = '';

        // handle page submissions
        if ($request->request->has('submitted')) {
            // get variables
            $username = trim(strtolower($request->request->get('username')));
            $password = trim($request->request->get('password'));
            $confirm_password = trim($request->request->get('confirm_password'));
            $account_status = trim($request->request->get('account_status'));
            $account_type = trim($request->request->get('account_type'));
            $expiry_date = trim($request->request->get('expiry_date'));
            $title = trim($request->request->get('title'));
            $first_name = trim($request->request->get('first_name'));
            $last_name = trim($request->request->get('last_name'));
            $email_address = trim(strtolower($request->request->get('email_address')));
            $storage_limit = trim($request->request->get('storage_limit'));
            $storage_limit = str_replace(array(',', ' ', '.', '(', ')', '-'), '', $storage_limit);
            $remainingBWDownload = trim($request->request->get('remainingBWDownload'));
            $remainingBWDownload = str_replace(array(',', ' ', '.', '(', ')', '-'), '', $remainingBWDownload);
            if ((int) $remainingBWDownload == 0) {
                $remainingBWDownload = null;
            }
            $dbExpiryDate = '';
            $upload_server_override = trim($request->request->get('upload_server_override'));
            $uploadedAvatar = null;
            if ($request->files->has('avatar') && !empty($request->files->get('avatar'))) {
                $uploadedAvatar = $request->files->get('avatar');
            }

            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            elseif ((strlen($username) < SITE_CONFIG_USERNAME_MIN_LENGTH) || (strlen($username) > SITE_CONFIG_USERNAME_MAX_LENGTH)) {
                AdminHelper::setError(AdminHelper::t("username_length_invalid"));
            }
            elseif ($password != $confirm_password) {
                AdminHelper::setError(AdminHelper::t("confirmation_password_does_not_match", "Your confirmation password does not match"));
            }
            elseif (strlen($first_name) == 0) {
                AdminHelper::setError(AdminHelper::t("enter_first_name"));
            }
            elseif (strlen($last_name) == 0) {
                AdminHelper::setError(AdminHelper::t("enter_last_name"));
            }
            elseif (strlen($email_address) == 0) {
                AdminHelper::setError(AdminHelper::t("enter_email_address"));
            }
            elseif (ValidationHelper::validEmail($email_address) == false) {
                AdminHelper::setError(AdminHelper::t("entered_email_address_invalid"));
            }
            elseif (strlen($expiry_date)) {
                // turn into db format
                $exp1 = explode(" ", $expiry_date);
                $exp = explode("/", $exp1[0]);
                if (COUNT($exp) != 3) {
                    AdminHelper::setError(AdminHelper::t("account_expiry_invalid_dd_mm_yy", "Account expiry date invalid, it should be in the format dd/mm/yyyy"));
                }
                else {
                    $dbExpiryDate = $exp[2] . '-' . $exp[1] . '-' . $exp[0] . ' 00:00:00';

                    // check format
                    if (strtotime($dbExpiryDate) == false) {
                        AdminHelper::setError(AdminHelper::t("account_expiry_invalid_dd_mm_yy", "Account expiry date invalid, it should be in the format dd/mm/yyyy"));
                    }
                }
            }

            // check password structure
            if (AdminHelper::isErrors() == false) {
                $passValid = UserHelper::validatePassword($password);
                if (is_array($passValid)) {
                    AdminHelper::setError(implode('<br/>', $passValid));
                }
            }

            // check email/username doesn't already exist
            if (AdminHelper::isErrors() == false) {
                $checkEmail = User::loadOneByClause('email = :email', array(
                            'email' => $email_address,
                                )
                );
                if ($checkEmail) {
                    // email exists
                    AdminHelper::setError(AdminHelper::t("email_address_already_exists", "Email address already exists on another account"));
                }
                else {
                    $checkUser = User::loadOneByClause('username = :username', array(
                                'username' => $username,
                                    )
                    );
                    if ($checkUser) {
                        // username exists
                        AdminHelper::setError(AdminHelper::t("username_already_exists", "Username already exists on another account"));
                    }
                }
            }

            if (AdminHelper::isErrors() == false) {
                if ($uploadedAvatar) {
                    // check filesize
                    $maxAvatarSize = 1024 * 1024 * 10;
                    if ($uploadedAvatar->getSize() > $maxAvatarSize) {
                        AdminHelper::setError(AdminHelper::t("account_edit_avatar_is_too_large", "The uploaded image can not be more than [[[MAX_SIZE_FORMATTED]]]", array('MAX_SIZE_FORMATTED' => CoreHelper::formatSize($maxAvatarSize))));
                    }
                    else {
                        // make sure it's an image
                        $imagesizedata = @getimagesize($uploadedAvatar->getPathName());
                        if ($imagesizedata === FALSE) {
                            //not image
                            AdminHelper::setError(AdminHelper::t("account_edit_avatar_is_not_an_image", "Your avatar must be a jpg, png or gif image."));
                        }
                    }
                }
            }

            // add the account
            if (AdminHelper::isErrors() == false) {
                // create the user
                $user = User::create();
                $user->username = $username;
                $user->password = Password::createHash($password);
                $user->level_id = $account_type;
                $user->email = $email_address;
                $user->status = $account_status;
                $user->title = $title;
                $user->firstname = $first_name;
                $user->lastname = $last_name;
                $user->paidExpiryDate = $dbExpiryDate;
                $user->storageLimitOverride = strlen($storage_limit) ? $storage_limit : NULL;
                $user->uploadServerOverride = (int) $upload_server_override ? (int) $upload_server_override : NULL;
                $user->remainingBWDownload = (int) $remainingBWDownload ? (int) $remainingBWDownload : NULL;
                $user->save();

                // create default folders
                $defaultUserFolders = trim(SITE_CONFIG_USER_REGISTER_DEFAULT_FOLDERS);
                if (strlen($defaultUserFolders)) {
                    $user->addDefaultFolders();
                }

                // save new avatar
                if ($uploadedAvatar) {
                    Image::load($uploadedAvatar->getPathName())
                            ->save(CACHE_DIRECTORY_ROOT . '/' . $avatarCachePath . '/avatar_original.png');
                }

                return $this->redirect('user_manage?sa=1');
            }
        }

        // load template
        return $this->render('admin/user_add.html', array_merge(array(
                    'accountTypeDetails' => $accountTypeDetails,
                    'accountStatusDetails' => $accountStatusDetails,
                    'titleItems' => $titleItems,
                    'serverDetails' => $serverDetails,
                    'defaultExpiryDate' => date('d/m/Y', strtotime('+1 year')),
                                ), $this->getHeaderParams()));
    }

    public function paymentManage() {
        // admin only
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // load template
        return $this->render('admin/payment_manage.html', array_merge(array(
                    'hasLog' => $request->query->has('log'),
                                ), $this->getHeaderParams()));
    }

    public function ajaxPaymentManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;
        $filterUserId = (int) $request->query->get('filterUserId') ? (int) $request->query->get('filterUserId') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'date_created';
        switch ($sortColumnName) {
            case 'payment_date':
                $sort = 'date_created';
                break;
            case 'user_name':
                $sort = 'users.username';
                break;
            case 'description':
                $sort = 'description';
                break;
            case 'amount':
                $sort = 'amount';
                break;
        }

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= "AND (users.username LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "description LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "from_email LIKE '%" . $filterText . "%')";
        }

        if (strlen($filterByUser)) {
            $sqlClause .= " AND user_id = " . (int) $filterByUser;
        }

        if (strlen($filterUserId)) {
            $sqlClause .= " AND user_id = " . (int) $filterUserId;
        }

        $totalRS = $db->getValue("SELECT COUNT(payment_log.id) AS total "
                . "FROM payment_log "
                . "LEFT JOIN users ON payment_log.user_id = users.id " . $sqlClause);
        $limitedRS = $db->getRows("SELECT payment_log.id, payment_log.date_created, "
                . "payment_log.description, payment_log.amount, payment_log.currency_code, "
                . "users.username, users.id AS user_id "
                . "FROM payment_log "
                . "LEFT JOIN users ON payment_log.user_id = users.id " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/process.png';
                $lRow[] = '<img src="' . $icon . '" width="16" height="16" title="payment" alt="payment"/>';
                $lRow[] = CoreHelper::formatDate($row['date_created'], SITE_CONFIG_DATE_TIME_FORMAT);
                $lRow[] = '<a href="user_manage?filterByAccountId=' . urlencode($row['user_id']) . '">' . AdminHelper::makeSafe($row['username']) . '</a>';
                $lRow[] = AdminHelper::makeSafe($row['description']);
                $lRow[] = AdminHelper::makeSafe($row['amount']) . ' ' . AdminHelper::makeSafe($row['currency_code']);

                $links = array();
                $links[] = '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="view" onClick="viewPaymentDetail(' . (int) $row['id'] . '); return false;"><span class="fa fa-info text-primary" aria-hidden="true"></span></a>';
                $lRow[] = '<div class="btn-group">' . implode(" ", $links) . '</div>';

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxPaymentManageAddForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // get initial data
        $users = $db->getRows('SELECT id, username, email '
                . 'FROM users '
                . 'ORDER BY username');
        $paymentMethods = array('PayPal', 'Cheque', 'Cash', 'Bank Transfer', 'SMS', 'Other');

        // default values
        $payment_date = CoreHelper::formatDate(time(), SITE_CONFIG_DATE_TIME_FORMAT);
        $description = 'Payment for account upgrade';

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/payment_manage_add_form.html', array(
            'users' => $users,
            'paymentMethods' => $paymentMethods,
            'payment_date' => $payment_date,
            'description' => $description,
            'payment_method' => $paymentMethods[0],
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxPaymentManageAddProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $user_id = trim($request->request->get('user_id'));
        $payment_date = trim($request->request->get('payment_date'));
        $payment_amount = (float) trim($request->request->get('payment_amount'));
        $description = trim($request->request->get('description'));
        $payment_method = trim($request->request->get('payment_method'));
        $notes = trim($request->request->get('notes'));

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (strlen($user_id) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("please_select_the_username", "Please select the username.");
        }
        elseif (strlen($payment_date) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("please_enter_the_payment_date", "Please enter the payment date.");
        }
        elseif ((float) $payment_amount == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("please_enter_the_payment_amount", "Please enter the payment amount.");
        }
        elseif (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // default description
            if (strlen($description) == 0) {
                $description = 'Payment of ' . SITE_CONFIG_COST_CURRENCY_SYMBOL . $payment_amount;
            }

            // reformat date for database
            $dbDate = date_create_from_format(SITE_CONFIG_DATE_TIME_FORMAT, $payment_date);

            // add the payment record
            $paymentLog = PaymentLog::create();
            $paymentLog->user_id = $user_id;
            $paymentLog->date_created = CoreHelper::formatDate($dbDate->getTimestamp(), 'Y-m-d H:i:s');
            $paymentLog->amount = $payment_amount;
            $paymentLog->currency_code = SITE_CONFIG_COST_CURRENCY_CODE;
            $paymentLog->description = $description;
            $paymentLog->request_log = $notes;
            $paymentLog->payment_method = $payment_method;
            $paymentLog->save();

            $result['error'] = false;
            $result['msg'] = 'Payment has been logged.';
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxPaymentManageDetail() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $paymentId = (int) $request->request->get('paymentId');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (!$paymentId) {
            $result['error'] = true;
            $result['msg'] = 'Failed finding payment information.';
        }
        else {
            // load all server statuses
            $sQL = "SELECT payment_log.id, payment_log.date_created, "
                    . "payment_log.description, payment_log.amount, payment_log.currency_code, "
                    . "payment_log.request_log, payment_log.payment_method, "
                    . "users.username, users.id AS user_id "
                    . "FROM payment_log "
                    . "LEFT JOIN users ON payment_log.user_id = users.id "
                    . "WHERE payment_log.id = :paymentId "
                    . "LIMIT 1";
            $paymentDetail = $db->getRow($sQL, array(
                'paymentId' => $paymentId,
            ));

            if (!$paymentDetail) {
                $result['error'] = true;
                $result['msg'] = 'Failed finding payment information.';
            }
            else {
                $result['html'] = $this->getRenderedTemplate('admin/ajax/payment_manage_detail.html', array(
                    'paymentDetail' => $paymentDetail,
                    'paymentNotes' => strlen($paymentDetail['request_log']) ? $paymentDetail['request_log'] : '-',
                    'paymentDate' => CoreHelper::formatDate($paymentDetail['date_created'], SITE_CONFIG_DATE_TIME_FORMAT),
                ));
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function paymentSubscriptionManage() {
        // admin only
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // load template
        return $this->render('admin/payment_subscription_manage.html', array_merge(array(
                                ), $this->getHeaderParams()));
    }

    public function ajaxPaymentSubscriptionManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'payment_subscription.date_added';
        switch ($sortColumnName) {
            case 'title':
                $sort = 'users.username';
                break;
            case 'date':
                $sort = 'payment_subscription.date_added';
                break;
            case 'payment_gateway':
                $sort = 'payment_subscription.payment_gateway';
                break;
            case 'status':
                $sort = 'payment_subscription.sub_status';
                break;
        }

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = strtolower($db->escape($filterText));
            $sqlClause .= "AND (LOWER(users.username) LIKE '" . $filterText . "%' OR ";
            $sqlClause .= "LOWER(payment_subscription.sub_status) = '" . $filterText . "%')";
        }

        $sQL = "SELECT payment_subscription.*, users.username "
                . "FROM payment_subscription "
                . "LEFT JOIN users ON payment_subscription.user_id = users.id ";
        $sQL .= $sqlClause . " ";
        $totalRS = $db->getRows($sQL);

        $sQL .= "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " ";
        $sQL .= "LIMIT " . $iDisplayStart . ", " . $iDisplayLength;
        $limitedRS = $db->getRows($sQL);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $pricingData = $db->getRow('SELECT pricing_label, period, price '
                        . 'FROM user_level_pricing '
                        . 'WHERE id = ' . (int) $row['user_level_pricing_id'] . ' '
                        . 'LIMIT 1');

                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/16px_' . $row['sub_status'] . '.png';
                $lRow[] = '<img src="' . $icon . '" width="16" height="16" title="subscription" alt="subscription"/>';
                $lRow[] = AdminHelper::makeSafe(CoreHelper::formatDate($row['date_added'], SITE_CONFIG_DATE_TIME_FORMAT));
                $lRow[] = AdminHelper::makeSafe($row['username']);
                $lRow[] = AdminHelper::makeSafe($pricingData['period']);
                $lRow[] = AdminHelper::makeSafe($pricingData['price']) . ' ' . SITE_CONFIG_COST_CURRENCY_CODE;
                $lRow[] = AdminHelper::makeSafe($row['payment_gateway']);
                $lRow[] = '<span class="statusText' . str_replace(" ", "", UCWords($row['sub_status'])) . '">' . UCWords($row['sub_status']) . '</span>';

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxGetUserFolderForSelect() {
        // admin restrictions
        $this->restrictAdminAccess(10);

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $import_account = trim($request->request->get('import_account'));

        if (!$import_account) {
            return $this->render404();
        }

        // load user
        $user = User::loadOneByClause('username = :username', array(
            'username' => $import_account,
        ));
        if (!$user) {
            return $this->render404();
        }

        // load the users folders
        $userFolders = FileFolderHelper::loadAllActiveForSelect($user->id);

        return $this->render('admin/ajax/get_user_folder_select.html', array(
                    'userFolders' => $userFolders,
        ));
    }

}
