<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use App\Models\FileFolder;
use App\Helpers\CacheHelper;
use App\Helpers\CoreHelper;
use App\Helpers\FileHelper;
use App\Helpers\FileFolderHelper;
use App\Helpers\SharingHelper;
use App\Helpers\UserHelper;
use App\Helpers\TranslateHelper;
use App\Helpers\PluginHelper;

class User extends Model
{
    /**
     * Table name based on the Model
     *
     * @var string
     */
    public static $tableName = 'users';

    public function hasProfileImage() {
        $avatarCachePath = 'user/' . (int) $this->id . '/profile_image/profile_original.jpg';
        if (CacheHelper::checkCacheFileExists($avatarCachePath)) {
            return true;
        }

        return false;
    }

    public function getProfileImageUrl() {
        return CACHE_WEB_ROOT . '/user/' . (int) $this->id . '/profile_image/profile_original.jpg';
    }

    public function storeProfileData($profileArr) {
        // get existing data
        $profileData = array();
        if (strlen($this->profile)) {
            $profileDataArr = json_decode($this->profile, true);
            if (is_array($profileDataArr)) {
                $profileData = $profileDataArr;
            }
        }

        // overwrite with new data
        foreach ($profileArr AS $k => $profileArrItem) {
            $profileData[$k] = $profileArrItem;
        }

        // update user
        $this->profile = json_encode($profileData, true);

        return $this->save();
    }

    public function getProfileValue($key, $childKey = null) {
        if (strlen($this->profile)) {
            $profileDataArr = json_decode($this->profile, true);
            if (is_array($profileDataArr)) {
                if (isset($profileDataArr[$key])) {
                    if ($childKey !== null) {
                        if (isset($profileDataArr[$key][$childKey])) {
                            return $profileDataArr[$key][$childKey];
                        }

                        return false;
                    }

                    return $profileDataArr[$key];
                }
            }
        }

        return false;
    }

    public function getAvatarUrl() {
        // setup avatar size
        $width = 110;
        $height = 110;

        // setup paths
        $avatarCachePath = 'user/' . $this->id . '/profile';
        $avatarCacheFilename = MD5($this->id . $width . $height . 'square') . '.png';

        // check if user has cached avatar
        if ($fileContent = CacheHelper::checkCacheFileExists($avatarCachePath . '/' . $avatarCacheFilename)) {
            return CACHE_WEB_ROOT . '/' . $avatarCachePath . '/' . $avatarCacheFilename;
        }

        // fallback, this should also create a cache copy
        return WEB_ROOT . '/account/avatar/' . $this->id . '/' . $width . 'x' . $height . '.png';
    }

    public function getImageWatermarkUrl() {
        $watermarkCachePath = 'user/' . (int) $this->id . '/watermark/watermark_original.png';
        if (CacheHelper::checkCacheFileExists($watermarkCachePath)) {
            return $watermarkCachePath;
        }

        return false;
    }

    public function getAvailableStorage() {
        return UserHelper::getAvailableFileStorage($this->id);
    }

    public function getTotalActiveFileSize() {
        return FileHelper::getTotalActiveFileSizeByUser($this->id);
    }

    public function getTotalActiveFiles() {
        return FileHelper::getTotalActiveFilesByUser($this->id);
    }
    
    public function getTotalSharedWithMeFiles() {
        return SharingHelper::getTotalSharedByUser($this->id);
    }

    public function getTotalTrashFiles() {
        return FileHelper::getTotalTrashFilesByUser($this->id);
    }

    public function getTotalDownloadCountAllFiles() {
        return FileHelper::getTotalDownloadsByUserOwnedFiles($this->id);
    }

    /**
     * @TODO - REVIEW ALL FUNCTIONS BELOW!
     */
    public function deleteUserData() {
        // connect db
        $db = Database::getDatabase();

        // remove database file records, this will not delete files, assume this is already done
        if ((int) $this->id > 0) {
            // stats
            $db->query('DELETE FROM stats '
                    . 'WHERE file_id IN (SELECT id FROM file WHERE userId = ' . (int) $this->id . ')');

            // files
            $db->query('DELETE FROM file '
                    . 'WHERE userId = ' . (int) $this->id);
        }

        // remove api keys
        $db->query('DELETE FROM apiv2_api_key '
                . 'WHERE user_id = ' . (int) $this->id);

        // remove folders
        $db->query('DELETE FROM file_folder '
                . 'WHERE userId = ' . (int) $this->id);

        // remove sessions
        $db->query('DELETE FROM sessions '
                . 'WHERE user_id = ' . (int) $this->id);

        // user record
        $db->query('DELETE FROM users '
                . 'WHERE id = ' . (int) $this->id);

        // append any plugin includes
        PluginHelper::includeAppends('objects_class_user_delete_user_data.inc.php', array('User' => $this));

        return true;
    }

    public function getAccountScreenName() {
        $label = strlen($this->firstname) ? ucwords($this->firstname) : $this->username;
        if (strlen($label) > 12) {
            $label = substr($label, 0, 12) . '...';
        }

        return $label;
    }

    public function getLastLoginFormatted() {
        if (strlen($this->lastlogindate) == 0) {
            return t('never', 'never');
        }

        return CoreHelper::formatDate($this->lastlogindate, 'D jS F y');
    }

    public function getTotalActiveFileCount() {
        // connect db
        $db = Database::getDatabase();

        // count active files
        return $db->getValue('SELECT COUNT(id) '
                        . 'FROM file '
                        . 'WHERE userId = ' . (int) $this->id . ' '
                        . 'AND status = "active"');
    }

    public function getTotalLikesCount() {
        $db = Database::getDatabase();
        return $db->getValue('SELECT SUM(total_likes) AS total '
                        . 'FROM file '
                        . 'WHERE userId = ' . (int) $this->id);
    }

    public function getProfileUrl() {
        return UserHelper::buildProfileUrl($this->username);
    }

    public function getLikesUrl() {
        return $this->getProfileUrl() . 'likes/';
    }

    public function addDefaultFolders() {
        $defaultUserFolders = trim(SITE_CONFIG_USER_REGISTER_DEFAULT_FOLDERS);
        if (strlen($defaultUserFolders) == 0) {
            return false;
        }

        // get each folder and add as root item
        $folderItems = explode('|', $defaultUserFolders);
        foreach ($folderItems AS $folderItem) {
            // create the folder
            $fileFolder = FileFolder::create();
            $fileFolder->userId = $this->id;
            $fileFolder->urlHash = FileFolderHelper::generateRandomFolderHash();
            $fileFolder->folderName = $folderItem;
            $fileFolder->isPublic = 2;
            $fileFolder->parentId = null;
            $fileFolder->showDownloadLinks = 1;
            $fileFolder->save();
        }
    }

    public function isAdmin() {
        return (int) $this->level_id === 20;
    }

    public function approveUser() {
        // connect db
        $db = Database::getDatabase();

        // update db
        $rs = $db->query('UPDATE users '
                . 'SET status="active" '
                . 'WHERE id = ' . (int) $this->id . ' '
                . 'LIMIT 1');

        // send confirmation to user
        $replacements = array(
            'FIRST_NAME' => $this->firstname,
            'SITE_NAME' => SITE_CONFIG_SITE_NAME,
            'WEB_ROOT' => WEB_ROOT,
            'ADMIN_WEB_ROOT' => ADMIN_WEB_ROOT,
            'USERNAME' => $this->username
        );
        $subject = TranslateHelper::t('register_user_approved_email_subject', 'Account for [[[SITE_NAME]]] - Approved!', array('SITE_NAME' => SITE_CONFIG_SITE_NAME));

        // override user email content
        $defaultContent = "Dear [[[FIRST_NAME]]],<br/><br/>";
        $defaultContent .= "Your account on [[[SITE_NAME]]] has been approved. You can now use the username and password we sent on the previous email to login.<br/><br/>";
        $defaultContent .= "Feel free to contact us if you need any support with your account.<br/><br/>";
        $defaultContent .= "Regards,<br/>";
        $defaultContent .= "[[[SITE_NAME]]] Admin";
        $htmlMsg = TranslateHelper::t('register_user_approved_email_content', $defaultContent, $replacements);
        CoreHelper::sendHtmlEmail($this->email, $subject, $htmlMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, strip_tags(str_replace("<br/>", "\n", $htmlMsg)));

        return $rs;
    }

    public function declineUser() {
        // send confirmation to user
        $replacements = array(
            'FIRST_NAME' => $this->firstname,
            'SITE_NAME' => SITE_CONFIG_SITE_NAME,
            'WEB_ROOT' => WEB_ROOT,
            'ADMIN_WEB_ROOT' => ADMIN_WEB_ROOT,
            'USERNAME' => $this->username
        );
        $subject = TranslateHelper::t('register_user_declined_email_subject', 'Account for [[[SITE_NAME]]] - Not Approved', array('SITE_NAME' => SITE_CONFIG_SITE_NAME));

        // override user email content
        $defaultContent = "Dear [[[FIRST_NAME]]],<br/><br/>";
        $defaultContent .= "Unfortunately your account on [[[SITE_NAME]]] has failed to meet the minimum requirements for the site at this time.<br/><br/>";
        $defaultContent .= "Feel free to contact us if you need any support with your account.<br/><br/>";
        $defaultContent .= "Regards,<br/>";
        $defaultContent .= "[[[SITE_NAME]]] Admin";
        $htmlMsg = TranslateHelper::t('register_user_declined_email_content', $defaultContent, $replacements);
        CoreHelper::sendHtmlEmail($this->email, $subject, $htmlMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, strip_tags(str_replace("<br/>", "\n", $htmlMsg)));

        // remove the actual account
        $rs = $this->deleteUserData();

        return $rs;
    }

}
