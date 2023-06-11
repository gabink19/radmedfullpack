<?php

namespace App\Helpers;

use App\Core\Database;
use App\Helpers\CacheHelper;
use App\Helpers\CoreHelper;
use App\Models\User;
use App\Models\UserLevel;
use App\Services\Password;
use App\Services\PasswordPolicy;

class UserHelper
{
    // note: $levelId is the account package id (user_level.id)
    static function getUserLevelValue($column, $levelId) {
        // run this through cache for better performance and less db queries
        $userLevelCacheArr = null;
        if (CacheHelper::cacheExists('DATA_USER_LEVEL') == false) {
            // load in cache from the database
            $userLevels = UserLevel::loadAll();

            // cache as kvp
            $userLevelCacheArr = array();
            foreach ($userLevels AS $userLevel) {
                $userLevelCacheArr[$userLevel->id] = $userLevel;
            }
            CacheHelper::setCache('DATA_USER_LEVEL', $userLevelCacheArr);
        }

        // check value in cache
        if ($userLevelCacheArr == null) {
            $userLevelCacheArr = CacheHelper::getCache('DATA_USER_LEVEL');
        }

        if(!isset($userLevelCacheArr[$levelId]) || (!property_exists($userLevelCacheArr[$levelId], $column))) {
            return null;
        }

        return $userLevelCacheArr[$levelId]->{$column};
    }
    
    static function getMaxFileStorage($userId = null) {
        $fallback = 1024 * 1024 * 1024 * 1024 * 5; // 5TB fallback
        $limit = $fallback;
        $Auth = null;
        $userLevel = 0;
        if ($userId === null) {
            $Auth = AuthHelper::getAuth();
            $userId = $Auth->id;
        }

        if ($userId !== null) {
            if ($Auth) {
                $userLevel = $Auth->package_id;
                $storageLimitOverride = $Auth->user->storageLimitOverride;
            }
            else {
                $user = User::loadOneById($userId);
                $userLevel = $user->level_id;
                $storageLimitOverride = $user->storageLimitOverride;
            }
        }

        // limit based on account type
        $str = self::getUserLevelValue('max_storage_bytes', $userLevel);
        $limit = ((strlen($str) == 0) || ($str == 0)) ? null : $str;

        // check for limit override
        if ((strlen($storageLimitOverride))) {
            $limit = $storageLimitOverride;
        }

        // for unlimited
        if ($limit == 0) {
            $limit = null;
        }

        return $limit;
    }
    
    /*
     * static method to validate password
     */
    static function validatePassword($password) {
        // start object
        $policy = new PasswordPolicy();

        // rules defined on object
        $policy->min_length = (int) SITE_CONFIG_PASSWORD_POLICY_MIN_LENGTH;
        $policy->max_length = (int) SITE_CONFIG_PASSWORD_POLICY_MAX_LENGTH;
        $policy->min_uppercase_chars = (int) SITE_CONFIG_PASSWORD_POLICY_MIN_UPPERCASE_CHARACTERS;
        $policy->min_numeric_chars = (int) SITE_CONFIG_PASSWORD_POLICY_MIN_NUMBERS;
        $policy->min_nonalphanumeric_chars = (int) SITE_CONFIG_PASSWORD_POLICY_MIN_NONALPHANUMERIC_CHARACTERS;

        // validate submitted password
        if ($policy->validate($password) == false) {
            return $policy->get_errors();
        }

        return true;
    }

    /*
     * static method to generate a password which adheres to the password policy
     */

    static function generatePassword() {
        $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ023456789!@#%&*?';
        $charsLength = strlen($chars);

        // calculate length of password to generate
        $generatedLength = 12;
        if ($generatedLength < SITE_CONFIG_PASSWORD_POLICY_MIN_LENGTH) {
            $generatedLength = SITE_CONFIG_PASSWORD_POLICY_MIN_LENGTH;
        }
        if ($generatedLength > SITE_CONFIG_PASSWORD_POLICY_MAX_LENGTH) {
            $generatedLength = SITE_CONFIG_PASSWORD_POLICY_MAX_LENGTH;
        }

        $passValid = array();
        $totalTries = 0;
        while (($passValid !== true) && ($totalTries < 100)) {
            // generate password
            srand((double) microtime() * 1000000);
            $i = 0;
            $password = '';
            while ($i < $generatedLength) {
                $num = rand() % $charsLength - 1;
                $tmp = substr($chars, $num, 1);
                $password = $password . $tmp;
                $i++;
            }

            $totalTries++;

            // check password meets password policy
            $passValid = self::validatePassword($password);
        }

        return $password;
    }
    
    static function create($username, $password, $email, $title, $firstname, $lastname, $accType = 'user') {
        // connect db
        $db = Database::getDatabase();

        // default free user level id
        $levelId = 1;
        $levelIdRs = (int) $db->getValue('SELECT id '
                . 'FROM user_level '
                . 'WHERE level_type = \'free\' '
                . 'AND id > 0 '
                . 'ORDER BY id ASC '
                . 'LIMIT 1');
        if ($levelIdRs) {
            $levelId = (int) $levelIdRs;
        }
        
        // figure out the account status
        $status = 'active';
        if(SITE_CONFIG_ADMIN_APPROVE_REGISTRATIONS === 'yes') {
            $status = 'awaiting approval';
        }
        
        // insert the new user
        $user = User::create();
        $user->username = $username;
        $user->password = Password::createHash($password);
        $user->email = $email;
        $user->title = $title;
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->datecreated = CoreHelper::sqlDateTime();
        $user->createdip = CoreHelper::getUsersIPAddress();
        $user->status = $status;
        $user->level_id = $levelId;
        $user->paymentTracker = MD5(time() . $username);
        $user->identifier = MD5(time() . $username . $password);
        if ($user->save()) {
            // create default folders
            $user->addDefaultFolders();
            
            // setup any newsletter settings (unsubscribed by default due to GDPR)
            if(PluginHelper::pluginEnabled('newsletters')) {
                // unsubscribe
                $db->query('INSERT INTO plugin_newsletter_unsubscribe '
                        . '(user_id, date_unsubscribed) '
                        . 'VALUES (:user_id, NOW())', array(
                    'user_id' => (int)$user->id,
                ));
            }

            return $user;
        }

        return false;
    }
    
    static function createPasswordResetHash($userId) {
        $user = true;

        // make sure it doesn't already exist on an account
        while ($user != false) {
            // create hash
            $hash = CoreHelper::generateRandomHash();

            // lookup by hash
            $user = self::loadUserByPasswordResetHash($hash);
        }

        // load user and update with new hash
        $user = User::loadOneById($userId);
        $user->passwordResetHash = $hash;
        $user->save();

        return $hash;
    }
    
    
    
    static function loadUserByPasswordResetHash($hash) {
        $user = User::loadOneByClause('passwordResetHash = :passwordResetHash', array(
            'passwordResetHash' => $hash,
        ));

        return $user;
    }


    static function loadUserByPaymentTracker($paymentTracker) {
        $user = User::loadOneByClause('paymentTracker = :paymentTracker', array(
            'paymentTracker' => $paymentTracker,
        ));

        return $user;
    }

    static function upgradeUserByPackageId($userId, $order) {
        // connect db
        $db = Database::getDatabase();

        // load user
        $user = User::loadOneById($userId);

        // load pricing info
        $price = $db->getRow('SELECT id, pricing_label, period, price, user_level_id '
                . 'FROM user_level_pricing '
                . 'WHERE id = :id '
                . 'LIMIT 1', array(
                    'id' => $order->user_level_pricing_id,
                ));
        if (!$price) {
            return false;
        }
        $days = (int) CoreHelper::convertStringDatePeriodToDays($price['period']);
        $newUserPackageId = $price['user_level_id'];

        // upgrade user
        $newExpiryDate = strtotime('+' . $days . ' days');

        // extend user if they are not a 'free' account
        $levelName = self::getUserLevelValue('level_type', $user->level_id);
        if ($levelName != 'free') {
            // add onto existing period
            $existingExpiryDate = strtotime($user->paidExpiryDate);

            // if less than today just revert to now
            if ($existingExpiryDate < time()) {
                $existingExpiryDate = time();
            }

            $newExpiryDate = (int) $existingExpiryDate + (int) ($days * (60 * 60 * 24));

            // if they are an admin or moderator keep the same account type, avoid downgrades resulting in non admin based accounts
            if ($levelName != 'paid') {
                $newUserPackageId = $user->level_id;
            }
        }

        // update user account to premium
        $user->level_id = $newUserPackageId;
        $user->lastPayment = date("Y-m-d H:i:s", time());
        $user->paidExpiryDate = date("Y-m-d H:i:s", $newExpiryDate);
        
        return $user->save();
    }

    static function getDefaultFreeAccountTypeId() {
        // connect db
        $db = Database::getDatabase();

        // load account id for free accounts
        $levelIdRs = (int) $db->getValue('SELECT id '
                . 'FROM user_level '
                . 'WHERE level_type = \'free\' '
                . 'AND id > 0 '
                . 'ORDER BY id ASC '
                . 'LIMIT 1');
        if ($levelIdRs) {
            return $levelIdRs;
        }

        // fallback
        return 1;
    }

    static function getAllAccountTypePackageIds($typeLabel = 'paid') {
        // connect db
        $db = Database::getDatabase();

        // preload all paid account types
        $paidAccountTypes = $db->getRows('SELECT id '
                . 'FROM user_level '
                . 'WHERE level_type = :level_type', array(
                    'level_type' => $typeLabel,
                ));
        if (!$paidAccountTypes) {
            return false;
        }

        // prepare in an array for the query below
        $paidAccountTypesArr = array();
        foreach ($paidAccountTypes AS $paidAccountType) {
            $paidAccountTypesArr[] = (int) $paidAccountType['id'];
        }

        return $paidAccountTypesArr;
    }

    static function downgradeExpiredAccounts() {
        // connect db
        $db = Database::getDatabase();

        // prepare in an array for the query below
        $paidAccountTypesArr = self::getAllAccountTypePackageIds();
        if (COUNT($paidAccountTypesArr) == 0) {
            return false;
        }

        // downgrade paid accounts
        $freeAccountTypeId = self::getDefaultFreeAccountTypeId();
        $sQL = 'UPDATE users '
                . 'SET level_id = :level_id '
                . 'WHERE level_id IN (' . implode(',', $paidAccountTypesArr) . ') '
                . 'AND UNIX_TIMESTAMP(paidExpiryDate) < ' . time();
        $rs = $db->query($sQL, array(
            'level_id' => $freeAccountTypeId,
        ));
    }

    static function getLevelLabel($packageId) {
        return self::getUserLevelValue('label', $packageId);
    }

    // used for old level id types
    static function getLevelIdFromPackageId($packageId) {
        $levelName = self::getUserLevelValue('level_type', $packageId);
        switch ($levelName) {
            case 'free':
                return 1;
                break;
            case 'paid':
                return 2;
                break;
            case 'moderator':
                return 10;
                break;
            case 'admin':
                return 20;
                break;
            default:
                return 0;
                break;
        }
    }

    static function getLevelTypeFromPackageId($packageId) {
        return self::getUserLevelValue('level_type', $packageId);
    }

    static function getAcceptedFileTypes($levelId = null) {
        $Auth = AuthHelper::getAuth();
        if ($levelId === null) {
            $levelId = $Auth->package_id;
        }

        $fileTypeStr = self::getUserLevelValue('accepted_file_types', $levelId);
        $rs = array();
        if (strlen(trim($fileTypeStr)) > 0) {
            $fileTypes = explode(";", trim($fileTypeStr));
            foreach ($fileTypes AS $fileType) {
                if (strlen(trim($fileType))) {
                    $rs[] = strtolower(trim($fileType));
                }
            }
        }
        sort($rs);

        return $rs;
    }

    static function getBlockedFileTypes($levelId = null) {
        $Auth = AuthHelper::getAuth();
        if ($levelId === null) {
            $levelId = $Auth->package_id;
        }

        $fileTypeStr = self::getUserLevelValue('blocked_file_types', $levelId);
        $rs = array();
        if (strlen(trim($fileTypeStr)) > 0) {
            $fileTypes = explode(";", trim($fileTypeStr));
            foreach ($fileTypes AS $fileType) {
                if (strlen(trim($fileType))) {
                    $rs[] = strtolower(trim($fileType));
                }
            }
        }
        sort($rs);

        return $rs;
    }

    static function getBlockedFilenameKeywords() {
        $rs = array();
        if (strlen(trim(SITE_CONFIG_BLOCKED_FILENAME_KEYWORDS)) > 0) {
            $keywords = explode("|", trim(SITE_CONFIG_BLOCKED_FILENAME_KEYWORDS));
            foreach ($keywords AS $keyword) {
                if (strlen(trim($keyword))) {
                    $rs[] = strtolower(trim($keyword));
                }
            }
        }

        return $rs;
    }

    static function getRemainingFilesToday($levelId = null) {
        $Auth = AuthHelper::getAuth();
        if ($levelId === null) {
            $levelId = $Auth->package_id;
        }

        $totalLimit = self::getUserLevelValue('max_uploads_per_day', $levelId);
        $totalLimit = $totalLimit == null ? 0 : (int) $totalLimit;
        if ((int) $totalLimit == 0) {
            return 10000;
        }

        $db = Database::getDatabase();
        $replacements = array();
        $sQL = 'SELECT COUNT(id) AS total '
                . 'FROM file '
                . 'WHERE DATE(uploadedDate) = DATE(NOW())';
        // limit by IP is user not logged in, otherwise use their account id
        if ($Auth->loggedIn() === false) {
            $sQL .= ' AND uploadedIP = :uploadedIP';
            $replacements['uploadedIP'] = CoreHelper::getUsersIPAddress();
        }
        else {
            $sQL .= ' AND userId = :userId';
            $replacements['userId'] = (int)$Auth->id;
        }

        $totalUploads = (int) $db->getValue($sQL, $replacements);
        $totalRemaining = (int) $totalLimit - $totalUploads;

        return $totalRemaining >= 0 ? $totalRemaining : 0;
    }

    // note: $levelId is the account package id (user_level.id)
    static function showSiteAdverts($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return self::getUserLevelValue('show_site_adverts', $levelId) == 1 ? true : false;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getAllowedToUpload($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return self::getUserLevelValue('can_upload', $levelId) == 1 ? true : false;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxDailyDownloads($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        $val = self::getUserLevelValue('downloads_per_24_hours', $levelId);
        return $val == null ? 0 : (int) $val;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxDownloadSize($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        $val = self::getUserLevelValue('max_download_filesize_allowed', $levelId);
        return $val == null ? 0 : (int) $val;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxDownloadSpeed($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        $val = self::getUserLevelValue('download_speed', $levelId);
        return $val == null ? 0 : (int) $val;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxRemoteUrls($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        $val = self::getUserLevelValue('max_remote_download_urls', $levelId);
        return $val == null ? 0 : (int) $val;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getUserAccessToRemoteUrlUpload($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        $val = self::getUserLevelValue('can_remote_download', $levelId);
        return $val == null ? 0 : (int) $val;
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxUploadFilesize($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        $val = self::getUserLevelValue('max_upload_size', $levelId);
        return strlen($val) ? $val : 0;
    }

    // note: $levelId is the account package id (user_level.id)
    static function showDownloadCaptcha($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        switch ($levelId) {
            // free user
            case 1:
                return (SITE_CONFIG_FREE_USER_SHOW_CAPTCHA == 'yes') ? true : false;
            // non user
            case 0:
                return (SITE_CONFIG_NON_USER_SHOW_CAPTCHA == 'yes') ? true : false;
            // paid & admin users
            default:
                return false;
        }
    }

    // note: $levelId is the account package id (user_level.id)
    static function getWaitTimeBetweenDownloads($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return self::getUserLevelValue('wait_between_downloads', $levelId);
    }

    // note: $levelId is the account package id (user_level.id)
    static function getDaysToKeepInactiveFiles($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return self::getUserLevelValue('days_to_keep_inactive_files', $levelId);
    }

    // note: $levelId is the account package id (user_level.id)
    static function getDaysToKeepTrashedFiles($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return (int) self::getUserLevelValue('days_to_keep_trashed_files', $levelId);
    }

    // note: $levelId is the account package id (user_level.id)
    static function enableUpgradePage($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return self::getUserLevelValue('show_upgrade_screen', $levelId) == 1 ? 'yes' : 'no';
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxDownloadThreads($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return (int) self::getUserLevelValue('concurrent_downloads', $levelId);
    }

    // note: $levelId is the account package id (user_level.id)
    static function getMaxUploadsAtOnce($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        return (int) self::getUserLevelValue('concurrent_uploads', $levelId);
    }

    // note: $levelId is the account package id (user_level.id)
    static function getTotalWaitingTime($levelId = null) {
        if ($levelId === null) {
            $Auth = AuthHelper::getAuth();
            $levelId = $Auth->package_id;
        }

        // lookup total waiting time
        $db = Database::getDatabase();
        $sQL = 'SELECT additional_settings '
                . 'FROM download_page '
                . 'WHERE user_level_id = :user_level_id';
        $rows = $db->getRows($sQL, array(
            'user_level_id' => (int)$levelId,
        ));
        $totalTime = 0;
        if ($rows) {
            foreach ($rows AS $row) {
                $additionalSettings = $row['additional_settings'];
                if (strlen($additionalSettings)) {
                    $additionalSettingsArr = json_decode($additionalSettings, true);
                    if (isset($additionalSettingsArr['download_wait'])) {
                        $totalTime = $totalTime + (int) $additionalSettingsArr['download_wait'];
                    }
                }
            }
        }

        return $totalTime;
    }

    static function getAvailableFileStorage($userId = null) {
        $fallback = 1024 * 1024 * 1024 * 1024 * 5; // 5TB fallback
        if ($userId === null) {
            $Auth = AuthHelper::getAuth();
            if ($Auth->loggedIn() == true) {
                $Auth = AuthHelper::getAuth();
                $userId = $Auth->id;
            }
            else {
                return $fallback;
            }
        }
        $maxFileStorage = self::getMaxFileStorage($userId);
        if (($maxFileStorage === null) || ($maxFileStorage === $fallback)) { // unlimited users
            return null;
        }

        // calculate total user
        $totalUsed = FileHelper::getTotalActiveFileSizeByUser($userId);
        if ($totalUsed > $maxFileStorage) {
            return 0;
        }

        return $maxFileStorage - $totalUsed;
    }

    static function getAdminApiDetails() {
        $db = Database::getDatabase();
        $rs = $db->getRow('SELECT users.id, username, apikey '
                . 'FROM users '
                . 'LEFT JOIN user_level ON users.level_id = user_level.id '
                . 'WHERE user_level.level_type = \'admin\' '
                . 'AND status=\'active\' '
                . 'LIMIT 1');
        if (!$rs) {
            return false;
        }

        // create key if we don't have one
        if (strlen($rs['apikey']) == 0) {
            $newKey = md5(microtime() . $rs['id'] . microtime());
            $db->query('UPDATE users '
                    . 'SET apikey = :apikey '
                    . 'WHERE id = :id '
                    . 'LIMIT 1', array(
                        'apikey' => $newKey,
                        'id' => (int) $rs['id'],
                    ));
            $rs = $db->getRow('SELECT id, username, apikey '
                    . 'FROM users '
                    . 'LEFT JOIN user_level ON users.level_id = user_level.id '
                    . 'WHERE user_level.level_type = \'admin\' '
                    . 'AND status=\'active\' '
                    . 'LIMIT 1');
        }

        return $rs;
    }

    static function getAvailableFileStoragePercentage($userId = null) {
        $fallback = 1024 * 1024 * 1024 * 1024 * 5; // 5TB fallback
        if ($userId === null) {
            $Auth = AuthHelper::getAuth();
            if ($Auth->loggedIn() == true) {
                $Auth = AuthHelper::getAuth();
                $userId = $Auth->id;
            }
            else {
                return 0;
            }
        }
        $maxFileStorage = self::getMaxFileStorage($userId);
        if (($maxFileStorage === null) || ($maxFileStorage === $fallback)) { // unlimited users
            return 100;
        }

        // calculate total user
        $totalUsed = FileHelper::getTotalActiveFileSizeByUser($userId);
        if ($totalUsed > $maxFileStorage) {
            return 100;
        }

        return 100 - (ceil(($totalUsed / $maxFileStorage) * 100));
    }

    static function hydrate($userDataArr) {
        return User::hydrateSingleRecord($userDataArr);
    }

    static function buildProfileUrl($username) {
        return CoreHelper::getCoreSitePath() . '/profile/' . $username . '/';
    }

    static function userTypeCanUseRemoteUrlUpload() {
        if (((int) self::getUserAccessToRemoteUrlUpload() === 0) || ((int) self::getMaxRemoteUrls() === 0)) {
            return false;
        }

        return true;
    }


    static function checkemail($email) {
        $db = Database::getDatabase();
        $rs = $db->getRow('SELECT email '
                . 'FROM users '
                . 'WHERE email = \''.$email.'\' '
                . 'AND status=\'active\' '
                . 'LIMIT 1');
        if (!$rs) {
            return false;
        }else{
            return true;
        }
    }

}
