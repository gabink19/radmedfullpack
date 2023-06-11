<?php



namespace App\Helpers;



use App\Core\Database;

use App\Models\File;

use App\Helpers\FileServerHelper;

use App\Helpers\FileServerContainerHelper;

use App\Helpers\PluginHelper;

use App\Helpers\LogHelper;



class FileHelper

{



    static function getTotalActiveFilesByUser($userId) {

        return File::count('(file.userId = :userId OR file.uploadedUserId = :userId) '

                        . 'AND file.status = "active"', array(

                    'userId' => $userId,

        ));

    }



    static function getTotalActiveFilesByUserFolderId($userId, $folderId = null) {

        $sQL = '(file.userId = :userId OR file.uploadedUserId = :userId) '

                . 'AND file.status = "active"';

        $replacements = array(

            'userId' => $userId,

        );

        if ($folderId !== null) {

            $sQL .= ' AND folderId = :folderId';

            $replacements['folderId'] = $folderId;

        }

        else {

            $sQL .= ' AND folderId IS NULL';

        }



        return File::count($sQL, $replacements);

    }



    static function getTotalDownloadsByUserOwnedFiles($userId) {

        return File::sum('visits', 'userId = :userId', array(

                    'userId' => $userId,

        ));

    }



    static function getTotalActiveFileSizeByUser($userId) {

        return File::sum('fileSize', '(userId = :userId OR file.uploadedUserId = :userId) AND status = "active"', array(

                    'userId' => $userId,

        ));

    }



    static function getTotalTrashFilesByUser($userId) {

        return File::count('userId = :userId '

                . 'AND status = "trash"', array(

                    'userId' => $userId,

        ));

    }



    /**

     * Load all active by folder id

     *

     * @param integer $folderId

     * @return array

     */

    static function loadAllActiveByFolderId($folderId) {

        return File::loadByClause('folderId = :folderId AND status = "active"', array(

                    'folderId' => $folderId,

                        ), 'originalFilename ASC');

    }



    static function getIconPreviewImageUrlLarger($fileArr, $ignorePlugins = false, $css = false) {

        return self::getIconPreviewImageUrl($fileArr, $ignorePlugins, 160, $css, 160, 160, 'padded');

    }



    static function getIconPreviewImageUrlLarge($fileArr, $ignorePlugins = false, $css = true) {

        return self::getIconPreviewImageUrl($fileArr, $ignorePlugins, 48, $css);

    }



    static function getIconPreviewImageUrlMedium($fileArr, $ignorePlugins = false) {

        return self::getIconPreviewImageUrl($fileArr, $ignorePlugins, 24);

    }



    static function getIconPreviewImageUrlSmall($fileArr, $ignorePlugins = false) {

        return self::getIconPreviewImageUrl($fileArr, $ignorePlugins, 16);

    }



    static function getIconPreviewImageUrl($fileArr, $ignorePlugins = false, $size, $css = false, $width = null, $height = null, $type = 'middle') {

        $iconFilePath = '/file_icons/' . $size . 'px/' . $fileArr['extension'] . '.png';

        $iconUrl = SITE_IMAGE_PATH . $iconFilePath;

        if ($css == true) {

            // return css class instead

            $iconUrl = 'sprite_icon_' . str_replace(array('+'), '', $fileArr['extension']);

        }

        if (!file_exists(DOC_ROOT . '/themes/' . SITE_CONFIG_SITE_THEME . '/assets/images' . $iconFilePath)) {

            $iconUrl = SITE_IMAGE_PATH . '/file_icons/' . $size . 'px/_page.png';

            if ($css == true) {

                // return css class instead

                $iconUrl = 'sprite_icon__page';

            }

        }



        // plugin previews
        if (($size > 24) && ($ignorePlugins == false)) {

            // call plugin hooks

            $params = PluginHelper::callHook('fileIconPreviewImageUrl', array(

                        'iconUrl' => $iconUrl,

                        'fileArr' => $fileArr,

                        'width' => $width,

                        'height' => $height,

                        'type' => $type,

            ));

            $iconUrl = $params['iconUrl'];

        }


        return $iconUrl;

    }



    /**

     * Load by short url

     *

     * @param string $shortUrl

     * @return file

     */

    static function loadByShortUrl($shortUrl) {

        // load our object based on the column

        return File::loadOneByShortUrl($shortUrl);

    }



    /**

     * Load by full url

     *

     * @param string $fileUrl

     * @return file

     */

    static function loadByFullUrl($fileUrl) {

        // figure out short url part

        $fileUrl = str_replace(array('http://', 'https://'), '', strtolower($fileUrl));



        // try to match domains

        $shortUrlSection = null;

        if (substr($fileUrl, 0, strlen(_CONFIG_SITE_FULL_URL)) == _CONFIG_SITE_FULL_URL) {

            $shortUrlSection = str_replace(_CONFIG_SITE_FULL_URL . '/', '', $fileUrl);

        }

        else {

            // load direct file servers

            $db = Database::getDatabase();

            $fileServers = $db->getRows('SELECT fileServerDomainName '

                    . 'FROM file_server '

                    . 'WHERE LENGTH(fileServerDomainName) > 0 '

                    . 'AND serverType = \'direct\'');

            if (COUNT($fileServers)) {

                foreach ($fileServers AS $fileServer) {

                    if (substr($fileUrl, 0, strlen($fileServer['fileServerDomainName'])) == $fileServer['fileServerDomainName']) {

                        $shortUrlSection = str_replace($fileServer['fileServerDomainName'] . '/', '', $fileUrl);

                    }

                }

            }

        }



        if ($shortUrlSection == null) {

            return false;

        }



        // break apart to get actual short url

        $shortUrl = current(explode("/", $shortUrlSection));



        return File::loadOneByShortUrl($shortUrl);

    }



    /**

     * Load by delete hash

     *

     * @param string $deleteHash

     * @return file

     */

    static function loadByDeleteHash($deleteHash) {

        // load our object based on the column

        return File::loadOne('deleteHash', $deleteHash);

    }



    /**

     * Create short url

     *

     * @param integer $in

     * @return string

     */

    static function createShortUrlPart($in) {

        // note: no need to check whether it already exists as it's handled by the code which calls this

        switch (SITE_CONFIG_GENERATE_UPLOAD_URL_TYPE) {

            case 'Medium Hash':

                return substr(MD5($in . microtime()), 0, 16);

                break;

            case 'Long Hash':

                return MD5($in . microtime());

                break;

        }



        // Shortest

        $codeset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $cbLength = strlen($codeset);

        $out = '';

        while ((int) $in > $cbLength - 1) {

            $out = $codeset[(int)fmod($in, $cbLength)] . $out;

            $in = floor($in / $cbLength);

        }



        return $codeset[(int)$in] . $out;

    }



    /**

     * Load all by account id

     *

     * @param integer $accountId

     * @return array

     */

    static function loadAllByAccount($accountId) {

        $db = Database::getDatabase();

        $rs = $db->getRows('SELECT * '

                . 'FROM file '

                . 'WHERE userId = :userId '

                . 'ORDER BY originalFilename', array(

            'userId' => $accountId,

        ));

        if (!is_array($rs)) {

            return false;

        }



        return $rs;

    }



    /**

     * Load all active by account id

     *

     * @param integer $accountId

     * @return array

     */

    static function loadAllActiveByAccount($accountId) {

        $db = Database::getDatabase();

        $rs = $db->getRows('SELECT * '

                . 'FROM file '

                . 'WHERE userId = :userId '

                . 'AND status = "active" '

                . 'ORDER BY originalFilename', array(

            'userId' => $accountId,

        ));

        if (!is_array($rs)) {

            return false;

        }



        return $rs;

    }



    /**

     * Load recent files based on account id

     *

     * @param integer $accountId

     * @return array

     */

    static function loadAllRecentByAccount($accountId, $activeOnly = false) {

        $db = Database::getDatabase(true);

        $rs = $db->getRows('SELECT * '

                . 'FROM file '

                . 'WHERE userId = :userId' . ($activeOnly === true ? ' AND status="active"' : '') . ' '

                . 'ORDER BY uploadedDate DESC '

                . 'LIMIT 10', array(

            'userId' => $accountId,

        ));

        if (!is_array($rs)) {

            return false;

        }



        return $rs;

    }



    /**

     * Load recent files based on IP address

     *

     * @param string $ip

     * @return array

     */

    static function loadAllRecentByIp($ip, $activeOnly = false) {

        $db = Database::getDatabase(true);

        $rs = $db->getRows('SELECT * '

                . 'FROM file '

                . 'WHERE uploadedIP = :uploadIP ' . ($activeOnly === true ? ' AND status="active"' : '') . ' '

                . 'AND userId IS NULL '

                . 'ORDER BY uploadedDate DESC '

                . 'LIMIT 10', array(

            'uploadIP' => $ip,

        ));

        if (!is_array($rs)) {

            return false;

        }



        return $rs;

    }



    /**

     * Get status label

     *

     * @param integer $status

     * @return string

     */

    static function getStatusLabel($status) {

        return t('file_status_' . str_replace(' ', '_', strtolower($status)), $status);

    }



    static function getUploadUrl() {

        // first check cache

        if (CacheHelper::cacheExists('UPLOADER_UPLOAD_URL') !== false) {

            return CacheHelper::getCache('UPLOADER_UPLOAD_URL');

        }


        // get available file server

        $db = Database::getDatabase();

        $fileServerId = FileServerHelper::getAvailableServerId();

        $sQL = "SELECT serverType, fileServerDomainName, scriptPath "

                . "FROM file_server "

                . "WHERE id = :id "

                . "LIMIT 1";

        $serverDetails = $db->getRow($sQL, array(

            'id' => $fileServerId,

        ));

        if ($serverDetails) {

            if ($serverDetails['serverType'] == 'direct') {

                $url = $serverDetails['fileServerDomainName'] . $serverDetails['scriptPath'];

                if (substr($url, strlen($url) - 1, 1) == '/') {

                    $url = substr($url, 0, strlen($url) - 1);

                }



                $uploadUrl = _CONFIG_SITE_PROTOCOL . "://" . $url;



                // store in cache for later

                CacheHelper::setCache('UPLOADER_UPLOAD_URL', $uploadUrl);



                return $uploadUrl;

            }

        }



        return WEB_ROOT;

    }



    /*

     * Get all direct file servers

     */



    static function getDirectFileServers() {

        $db = Database::getDatabase();

        $sQL = "SELECT id, serverType, fileServerDomainName, scriptPath "

                . "FROM file_server "

                . "WHERE serverType='direct' "

                . "ORDER BY fileServerDomainName";



        return $db->getRows($sQL);

    }



    static function getValidReferrers($formatted = false) {

        $pre = '';

        if ($formatted == true) {

            $pre = _CONFIG_SITE_PROTOCOL . '://';

        }



        $validUrls = array();

        $validUrls[$pre . _CONFIG_SITE_HOST_URL] = $pre . _CONFIG_SITE_HOST_URL;

        $directFileServers = self::getDirectFileServers();

        if (COUNT($directFileServers)) {

            foreach ($directFileServers AS $directFileServer) {

                $fileServerDomainName = $directFileServer['fileServerDomainName'];

                $validUrls[$pre . $fileServerDomainName] = $pre . $directFileServer['fileServerDomainName'];

            }

        }



        return $validUrls;

    }



    static function getFileDomainAndPath($fileId = null, $fileServerId = null, $finalDownloadBasePath = false, $cdnUrl = false) {

        // get database connection

        $db = Database::getDatabase();

        if ($fileServerId == null) {

            $fileServerId = $db->getValue('SELECT serverId '

                    . 'FROM file '

                    . 'WHERE id = :id '

                    . 'LIMIT 1', array(

                'id' => (int) $fileId,

            ));

        }



        if ((int) $fileServerId) {

            // get file server data

            $fileServers = self::getFileServerData();

            $fileServer = $fileServers[$fileServerId];

            if ($fileServer) {

                if (strlen($fileServer['fileServerDomainName'])) {

                    // get path from file server

                    $path = $fileServer['fileServerDomainName'] . $fileServer['scriptPath'];



                    // use the cdn url if it's set

                    if ($cdnUrl === true) {

                        $serverConfigArr = json_decode($fileServer['serverConfig'], true);

                        if ((isset($serverConfigArr['cdn_url'])) && (strlen($serverConfigArr['cdn_url']))) {

                            $path = $serverConfigArr['cdn_url'] . $fileServer['scriptPath'];

                        }

                    }



                    // if not direct download link and file server is set to route via main site, override path to this site

                    if (($finalDownloadBasePath == false) && ($fileServer['routeViaMainSite'] == 1)) {

                        $path = _CONFIG_CORE_SITE_FULL_URL;

                    }



                    // tidy url

                    if (substr($path, strlen($path) - 1, 1) == '/') {

                        $path = substr($path, 0, strlen($path) - 1);

                    }



                    return $path;

                }



                // use the cdn url if it's set

                if ($cdnUrl === true) {

                    $serverConfigArr = json_decode($fileServer['serverConfig'], true);

                    if ((isset($serverConfigArr['cdn_url'])) && (strlen($serverConfigArr['cdn_url']))) {

                        return $serverConfigArr['cdn_url'] . str_replace(_CONFIG_CORE_SITE_HOST_URL, '', _CONFIG_CORE_SITE_FULL_URL);

                    }

                }

            }

        }



        return _CONFIG_CORE_SITE_FULL_URL;

    }



    static function getFileUrl($fileId, $file = null) {

        if (!$file) {

            $file = File::loadOneById((int) $fileId);

        }



        if (!$file) {

            return false;

        }



        return $file->getFullShortUrl();

    }



    static function getFileStatisticsUrl($fileId, $file = null) {

        if (!$file) {

            $file = File::loadOneById((int) $fileId);

        }



        if (!$file) {

            return false;

        }



        return $file->getStatisticsUrl();

    }



    static function getFileDeleteUrl($fileId, $file = null) {

        if (!$file) {

            $file = File::loadOneById((int) $fileId);

        }



        if (!$file) {

            return false;

        }



        return $file->getDeleteUrl();

    }



    static function getFileInfoUrl($fileId, $file = null) {

        if (!$file) {

            $file = File::loadOneById((int) $fileId);

        }



        if (!$file) {

            return false;

        }



        return $file->getInfoUrl();

    }



    static function getFileShortInfoUrl($fileId, $file = null) {

        if (!$file) {

            $file = File::loadOneById((int) $fileId);

        }



        if (!$file) {

            return false;

        }



        return $file->getShortInfoUrl();

    }



    static function getTotalActiveFileStats() {

        if (CacheHelper::cacheExists(__METHOD__)) {

            return CacheHelper::getCache(__METHOD__);

        }



        $db = Database::getDatabase();

        $rs = $db->getRow('SELECT COUNT(file.id) AS totalFileCount, SUM(visits) AS totalVisits '

                . 'FROM file '

                . 'WHERE file.status = "active"');

        CacheHelper::setCache(__METHOD__, $rs);



        return CacheHelper::getCache(__METHOD__);

    }



    static function getTotalActivePublicFileStats() {

        if (CacheHelper::cacheExists(__METHOD__)) {

            return CacheHelper::getCache(__METHOD__);

        }



        $db = Database::getDatabase();

        $rs = $db->getRow('SELECT COUNT(file.id) AS totalFileCount, SUM(file.fileSize) AS totalFileSize '

                . 'FROM file '

                . 'LEFT JOIN file_folder ON file.folderId = file_folder.id '

                . 'WHERE file.status = "active" '

                . 'AND (file_folder.isPublic = 2 OR file.userId IS NULL)');

        CacheHelper::setCache(__METHOD__, $rs);



        return CacheHelper::getCache(__METHOD__);

    }



    static function getTotalActivePublicFiles() {

        if (CacheHelper::cacheExists(__METHOD__)) {

            return CacheHelper::getCache(__METHOD__);

        }



        $rs = self::getTotalActivePublicFileStats();

        CacheHelper::setCache(__METHOD__, $rs['totalFileCount']);



        return CacheHelper::getCache(__METHOD__);

    }



    static function getTotalActivePublicFilesize() {

        if (CacheHelper::cacheExists(__METHOD__)) {

            return CacheHelper::getCache(__METHOD__);

        }



        $rs = self::getTotalActivePublicFileStats();

        CacheHelper::setCache(__METHOD__, $rs['totalFileSize']);



        return CacheHelper::getCache(__METHOD__);

    }



    /**

     * Update used file storage stats, only allow this once every 5 minutes

     */

    static function updateFileServerStorageStats($serverId = null, $force = false) {

        if ($force == false) {

            $nextCheckTimestamp = (int) SITE_CONFIG_NEXT_CHECK_FOR_SERVER_STATS_UPDATE;

            if ($nextCheckTimestamp >= time()) {

                return false;

            }

        }



        $db = Database::getDatabase();



        // update stats

        if ($serverId == null) {

            $servers = $db->getRows('SELECT id '

                    . 'FROM file_server');

        }

        else {

            $servers = array();

            $servers[] = array('id' => $serverId);

        }



        foreach ($servers AS $server) {

            // server id

            $serverId = (int) $server['id'];



            // get total space used

            $totalPre = (float) $db->getValue('SELECT SUM(file.fileSize) AS total '

                            . 'FROM file '

                            . 'WHERE file.status != "deleted" '

                            . 'AND fileHash IS NULL '

                            . 'AND file.serverId = ' . (int) $serverId . ' '

                            . 'GROUP BY file.serverId');

            $totalPost = (float) $db->getValue('SELECT SUM(fileSelect.fileSize) AS total '

                            . 'FROM (SELECT fileSize, status, fileHash, serverId FROM file WHERE file.fileHash IS NOT NULL AND serverId = ' . (int) $serverId . ' GROUP BY file.fileHash) AS fileSelect '

                            . 'WHERE fileSelect.status != "deleted" '

                            . 'AND fileSelect.fileHash IS NOT NULL '

                            . 'AND fileSelect.serverId = ' . $serverId . ' '

                            . 'GROUP BY fileSelect.serverId');

            $totalFiles = (int) $db->getValue('SELECT COUNT(1) AS total '

                            . 'FROM file '

                            . 'WHERE file.status != "deleted" '

                            . 'AND file.serverId = ' . (int) $serverId);



            // update with new totals

            $db->query('UPDATE file_server '

                    . 'SET totalSpaceUsed = ' . (float) $db->escape($totalPre + $totalPost) . ', '

                    . 'totalFiles = ' . (int) $db->escape($totalFiles) . ' '

                    . 'WHERE id = ' . $serverId . ' '

                    . 'LIMIT 1');

        }



        // set next check in 5 minutes time

        $nextCheckNew = time() + (60 * 5);

        $db->query("UPDATE site_config "

                . "SET config_value=" . $db->quote($nextCheckNew) . " "

                . "WHERE config_key='next_check_for_server_stats_update' "

                . "LIMIT 1");

    }



    static function purgeDownloadTokens() {

        // get database

        $db = Database::getDatabase();



        // delete old token data

        $db->query('DELETE FROM download_token '

                . 'WHERE expiry < :expiry', array(

            'expiry' => date('Y-m-d H:i:s'),

                )

        );

    }



    public function decodeNextPageHash($hash) {

        // get the encrypted hash

        $encrypted = base64_decode($hash);



        // decrypt

        $decrypted = rtrim(CoreHelper::decryptValue($encrypted));



        // return the decrypted value

        return $decrypted;

    }



    static function loadServerDetails($serverId) {

        // load from the db

        $db = Database::getDatabase();

        $uploadServerDetails = $db->getRow('SELECT * '

                . 'FROM file_server '

                . 'WHERE id = :id '

                . 'LIMIT 1', array(

            'id' => $serverId,

        ));

        if (!$uploadServerDetails) {

            return false;

        }



        $serverConfigArr = '';

        if (strlen($uploadServerDetails['serverConfig'])) {

            $serverConfig = json_decode($uploadServerDetails['serverConfig'], true);

            if (is_array($serverConfig)) {

                $serverConfigArr = $serverConfig;

            }

        }

        $uploadServerDetails['serverConfig'] = $serverConfigArr;



        return $uploadServerDetails;

    }



    static function getFileServerData() {

        if (($fileServersArr = CacheHelper::getCache('FILE_SERVER_DATA')) === false) {

            $db = Database::getDatabase();

            $fileServers = $db->getRows('SELECT * '

                    . 'FROM file_server WHERE statusId <> 1 '

                    . 'ORDER BY serverLabel');

            $fileServersArr = array();

            foreach ($fileServers AS $fileServer) {

                $fileServerId = $fileServer['id'];

                $fileServersArr[$fileServerId] = $fileServer;

            }

            CacheHelper::setCache('FILE_SERVER_DATA', $fileServersArr);

        }



        return $fileServersArr;

    }



    static function getCurrentServerDetails() {

        // get file server cache

        $fileServers = self::getFileServerData();



        // get current file server id

        $fileServerId = self::getCurrentServerId();

        if ($fileServerId) {

            foreach ($fileServers AS $fileServer) {

                if ((int) $fileServer['id'] == $fileServerId) {

                    return $fileServer;

                }

            }

        }



        return false;

    }



    // load server id based on site config

    static function getCurrentServerId() {

        // get file server cache

        $fileServers = self::getFileServerData();



        // get server id for direct file servers

        foreach ($fileServers AS $fileServer) {

            if (($fileServer['fileServerDomainName'] == _CONFIG_SITE_HOST_URL) && ($fileServer['serverType'] == 'direct')) {

                return (int) $fileServer['id'];

            }

        }



        // fallback to local server

        $serverId = self::getDefaultLocalServerId();

        if ((int) $serverId) {

            return $serverId;

        }



        return false;

    }



    static function getDefaultLocalServerId() {

        // get file server cache

        $fileServers = self::getFileServerData();



        foreach ($fileServers AS $fileServer) {

            if (($fileServer['serverLabel'] == 'Local Default') && ($fileServer['serverType'] == 'local')) {

                return (int) $fileServer['id'];

            }

        }



        // load the first local server

        foreach ($fileServers AS $fileServer) {

            if ($fileServer['serverType'] == 'local') {

                return (int) $fileServer['id'];

            }

        }



        return false;

    }



    static function getServerDetailsById($fileServerId) {

        // get file server cache

        $fileServers = self::getFileServerData();



        // load the data, we do it this way so the file server data is loaded from cache

        foreach ($fileServers AS $fileServer) {

            if ((int) $fileServer['id'] == $fileServerId) {

                return $fileServer;

            }

        }



        return false;

    }



    static function deleteRedundantFiles() {

        // connect db

        $db = Database::getDatabase();

        $limit = 1000;



        // setup server ids, we need this to be an array to allow for multiple drives on the same server

        $server = self::getCurrentServerDetails();

        $serverIds = array();

        if ($server['serverType'] == 'local') {

            // load other servers

            $servers = $db->getRows('SELECT id '

                    . 'FROM file_server '

                    . 'WHERE serverType != \'direct\'');

            foreach ($servers AS $serverItem) {

                $serverIds[] = (int) $serverItem['id'];

            }

        }

        else {

            $serverIds[] = (int) $server['id'];

        }



        // get all account types

        $accountTypes = $db->getRows('SELECT id, level_type '

                . 'FROM user_level '

                . 'ORDER BY id ASC');

        foreach ($accountTypes AS $accountType) {

            // get after how long to remove

            $fileRemovalPeriod = (int) trim(UserHelper::getDaysToKeepInactiveFiles($accountType['id']));



            // set a maximum of 5 years otherwise we hit unix timestamp calculation issues

            if ($fileRemovalPeriod > 1825) {

                $fileRemovalPeriod = 1825;

            }



            // block zero

            if ($fileRemovalPeriod == 0) {

                continue;

            }



            // create sql to remove find files for account type

            $sQL = 'SELECT file.id ';

            $sQL .= 'FROM file LEFT JOIN users ';

            $sQL .= 'ON file.userId = users.id ';

            $sQL .= 'WHERE file.status = "active" AND ';

            $sQL .= 'UNIX_TIMESTAMP(file.uploadedDate) < ' . strtotime('-' . $fileRemovalPeriod . ' days') . ' AND ';

            $sQL .= '(UNIX_TIMESTAMP(file.lastAccessed) < ' . strtotime('-' . $fileRemovalPeriod . ' days') . ' OR file.lastAccessed IS NULL) ';

            $sQL .= 'AND (file.userId ';



            // non-accounts

            if ($accountType['level_type'] == 'nonuser') {

                $sQL .= 'IS NULL';

            }

            // accounts

            else {

                $sQL .= 'IN (SELECT id FROM users WHERE level_id = ' . (int) $accountType['id'] . ')';

            }



            $sQL .= ') AND file.serverId IN (' . implode(',', $serverIds) . ') LIMIT ' . $limit . ';';



            $rows = $db->getRows($sQL);

            if (is_array($rows)) {

                foreach ($rows AS $row) {

                    // load file object

                    $file = File::loadOneById($row['id']);

                    if ($file) {

                        // remove file

                        $file->removeBySystem();

                    }

                }

            }

        }

    }



    static function deleteTrashedFiles() {

        // connect db

        $db = Database::getDatabase();

        $limit = 1000;



        // setup server ids, we need this to be an array to allow for multiple drives on the same server

        $server = self::getCurrentServerDetails();

        $serverIds = array();

        if ($server['serverType'] == 'local') {

            // load other servers

            $servers = $db->getRows('SELECT id '

                    . 'FROM file_server '

                    . 'WHERE serverType != \'direct\'');

            foreach ($servers AS $serverItem) {

                $serverIds[] = (int) $serverItem['id'];

            }

        }

        else {

            $serverIds[] = (int) $server['id'];

        }



        // get all account types

        $accountTypes = $db->getRows('SELECT id, level_type '

                . 'FROM user_level '

                . 'ORDER BY id ASC');

        foreach ($accountTypes AS $accountType) {

            // get after how long to remove

            $fileRemovalPeriod = (int) trim(UserHelper::getDaysToKeepTrashedFiles($accountType['id']));



            // set a maximum of 5 years otherwise we hit unix timestamp calculation issues

            if ($fileRemovalPeriod > 1825) {

                $fileRemovalPeriod = 1825;

            }



            // block zero

            if ($fileRemovalPeriod == 0) {

                continue;

            }



            // create sql to remove find files for account type

            $sQL = 'SELECT file.id ';

            $sQL .= 'FROM file LEFT JOIN users ';

            $sQL .= 'ON file.userId = users.id ';

            $sQL .= 'WHERE file.status = "trash" AND ';

            $sQL .= 'UNIX_TIMESTAMP(file.date_updated) < ' . strtotime('-' . $fileRemovalPeriod . ' days') . ' ';

            $sQL .= 'AND (file.userId IN (SELECT id FROM users WHERE level_id = ' . (int) $accountType['id'] . ')'

                    . ') AND file.serverId IN (' . implode(',', $serverIds) . ') '

                    . 'AND folderId IS NULL '

                    . 'LIMIT ' . $limit . ';';



            $rows = $db->getRows($sQL);

            if (is_array($rows)) {

                foreach ($rows AS $row) {

                    // load file object

                    $file = File::loadOneById($row['id']);

                    if ($file) {

                        // remove file

                        $file->removeBySystem();

                    }

                }

            }



            // remove folders

            $sQL = 'SELECT file_folder.id ';

            $sQL .= 'FROM file_folder LEFT JOIN users ';

            $sQL .= 'ON file_folder.userId = users.id ';

            $sQL .= 'WHERE file_folder.status = "trash" AND ';

            $sQL .= 'UNIX_TIMESTAMP(file_folder.date_updated) < ' . strtotime('-' . $fileRemovalPeriod . ' days') . ' ';

            $sQL .= 'AND (file_folder.userId ';

            $sQL .= 'IN (SELECT id FROM users WHERE level_id = ' . (int) $accountType['id'] . ')'

                    . ') AND parentId IS NULL '

                    . 'LIMIT ' . $limit;



            $rows = $db->getRows($sQL);

            if (is_array($rows)) {

                foreach ($rows AS $row) {

                    // load file object

                    $fileFolder = fileFolder::loadById($row['id']);

                    if ($fileFolder) {

                        // remove file

                        $fileFolder->removeBySystem();

                    }

                }

            }

        }

    }



    // returns a file's mimetype based on its extension

    static function estimateMimeTypeFromExtension($filename, $default = 'application/octet-stream') {

        $mimeTypes = array(

            '323' => 'text/h323',

            'acx' => 'application/internet-property-stream',

            'ai' => 'application/postscript',

            'aif' => 'audio/x-aiff',

            'aifc' => 'audio/x-aiff',

            'aiff' => 'audio/x-aiff',

            'asf' => 'video/x-ms-asf',

            'asr' => 'video/x-ms-asf',

            'asx' => 'video/x-ms-asf',

            'au' => 'audio/basic',

            'avi' => 'video/x-msvideo',

            'axs' => 'application/olescript',

            'bas' => 'text/plain',

            'bcpio' => 'application/x-bcpio',

            'bin' => 'application/octet-stream',

            'bmp' => 'image/bmp',

            'c' => 'text/plain',

            'cat' => 'application/vnd.ms-pkiseccat',

            'cdf' => 'application/x-cdf',

            'cer' => 'application/x-x509-ca-cert',

            'class' => 'application/octet-stream',

            'clp' => 'application/x-msclip',

            'cmx' => 'image/x-cmx',

            'cod' => 'image/cis-cod',

            'cpio' => 'application/x-cpio',

            'crd' => 'application/x-mscardfile',

            'crl' => 'application/pkix-crl',

            'crt' => 'application/x-x509-ca-cert',

            'csh' => 'application/x-csh',

            'css' => 'text/css',

            'dcr' => 'application/x-director',

            'der' => 'application/x-x509-ca-cert',

            'dir' => 'application/x-director',

            'dll' => 'application/x-msdownload',

            'dms' => 'application/octet-stream',

            'doc' => 'application/msword',

            'dot' => 'application/msword',

            'dvi' => 'application/x-dvi',

            'dxr' => 'application/x-director',

            'eps' => 'application/postscript',

            'etx' => 'text/x-setext',

            'evy' => 'application/envoy',

            'exe' => 'application/octet-stream',

            'fif' => 'application/fractals',

            'flac' => 'audio/flac',

            'flr' => 'x-world/x-vrml',

            'gif' => 'image/gif',

            'gtar' => 'application/x-gtar',

            'gz' => 'application/x-gzip',

            'h' => 'text/plain',

            'hdf' => 'application/x-hdf',

            'hlp' => 'application/winhlp',

            'hqx' => 'application/mac-binhex40',

            'hta' => 'application/hta',

            'htc' => 'text/x-component',

            'htm' => 'text/html',

            'html' => 'text/html',

            'htt' => 'text/webviewhtml',

            'ico' => 'image/x-icon',

            'ief' => 'image/ief',

            'iii' => 'application/x-iphone',

            'ins' => 'application/x-internet-signup',

            'isp' => 'application/x-internet-signup',

            'jfif' => 'image/pipeg',

            'jpe' => 'image/jpeg',

            'jpeg' => 'image/jpeg',

            'jpg' => 'image/jpeg',

            'js' => 'application/x-javascript',

            'latex' => 'application/x-latex',

            'lha' => 'application/octet-stream',

            'lsf' => 'video/x-la-asf',

            'lsx' => 'video/x-la-asf',

            'lzh' => 'application/octet-stream',

            'm13' => 'application/x-msmediaview',

            'm14' => 'application/x-msmediaview',

            'm3u' => 'audio/x-mpegurl',

            'm4v' => 'video/mp4',

            'man' => 'application/x-troff-man',

            'mdb' => 'application/x-msaccess',

            'me' => 'application/x-troff-me',

            'mht' => 'message/rfc822',

            'mhtml' => 'message/rfc822',

            'mid' => 'audio/mid',

            'mny' => 'application/x-msmoney',

            'mov' => 'video/quicktime',

            'movie' => 'video/x-sgi-movie',

            'mp2' => 'video/mpeg',

            'mp3' => 'audio/mpeg',

            'mp4' => 'video/mp4',

            'mpa' => 'video/mpeg',

            'mpe' => 'video/mpeg',

            'mpeg' => 'video/mpeg',

            'mpg' => 'video/mpeg',

            'mpp' => 'application/vnd.ms-project',

            'mpv2' => 'video/mpeg',

            'ms' => 'application/x-troff-ms',

            'mvb' => 'application/x-msmediaview',

            'nws' => 'message/rfc822',

            'oda' => 'application/oda',

            'oga' => 'audio/ogg',

            'ogg' => 'audio/ogg',

            'ogv' => 'video/ogg',

            'ogx' => 'application/ogg',

            'p10' => 'application/pkcs10',

            'p12' => 'application/x-pkcs12',

            'p7b' => 'application/x-pkcs7-certificates',

            'p7c' => 'application/x-pkcs7-mime',

            'p7m' => 'application/x-pkcs7-mime',

            'p7r' => 'application/x-pkcs7-certreqresp',

            'p7s' => 'application/x-pkcs7-signature',

            'pbm' => 'image/x-portable-bitmap',

            'pdf' => 'application/pdf',

            'pfx' => 'application/x-pkcs12',

            'pgm' => 'image/x-portable-graymap',

            'pko' => 'application/ynd.ms-pkipko',

            'pma' => 'application/x-perfmon',

            'pmc' => 'application/x-perfmon',

            'pml' => 'application/x-perfmon',

            'pmr' => 'application/x-perfmon',

            'pmw' => 'application/x-perfmon',

            'pnm' => 'image/x-portable-anymap',

            'pot' => 'application/vnd.ms-powerpoint',

            'ppm' => 'image/x-portable-pixmap',

            'pps' => 'application/vnd.ms-powerpoint',

            'ppt' => 'application/vnd.ms-powerpoint',

            'prf' => 'application/pics-rules',

            'ps' => 'application/postscript',

            'pub' => 'application/x-mspublisher',

            'qt' => 'video/quicktime',

            'ra' => 'audio/x-pn-realaudio',

            'ram' => 'audio/x-pn-realaudio',

            'ras' => 'image/x-cmu-raster',

            'rgb' => 'image/x-rgb',

            'rmi' => 'audio/mid',

            'roff' => 'application/x-troff',

            'rtf' => 'application/rtf',

            'rtx' => 'text/richtext',

            'scd' => 'application/x-msschedule',

            'sct' => 'text/scriptlet',

            'setpay' => 'application/set-payment-initiation',

            'setreg' => 'application/set-registration-initiation',

            'sh' => 'application/x-sh',

            'shar' => 'application/x-shar',

            'sit' => 'application/x-stuffit',

            'snd' => 'audio/basic',

            'spc' => 'application/x-pkcs7-certificates',

            'spl' => 'application/futuresplash',

            'src' => 'application/x-wais-source',

            'sst' => 'application/vnd.ms-pkicertstore',

            'stl' => 'application/vnd.ms-pkistl',

            'stm' => 'text/html',

            'svg' => "image/svg+xml",

            'sv4cpio' => 'application/x-sv4cpio',

            'sv4crc' => 'application/x-sv4crc',

            't' => 'application/x-troff',

            'tar' => 'application/x-tar',

            'tcl' => 'application/x-tcl',

            'tex' => 'application/x-tex',

            'texi' => 'application/x-texinfo',

            'texinfo' => 'application/x-texinfo',

            'tgz' => 'application/x-compressed',

            'tif' => 'image/tiff',

            'tiff' => 'image/tiff',

            'tr' => 'application/x-troff',

            'trm' => 'application/x-msterminal',

            'tsv' => 'text/tab-separated-values',

            'txt' => 'text/plain',

            'uls' => 'text/iuls',

            'ustar' => 'application/x-ustar',

            'vcf' => 'text/x-vcard',

            'vrml' => 'x-world/x-vrml',

            'wav' => 'audio/x-wav',

            'wcm' => 'application/vnd.ms-works',

            'wdb' => 'application/vnd.ms-works',

            'wks' => 'application/vnd.ms-works',

            'wmf' => 'application/x-msmetafile',

            'wps' => 'application/vnd.ms-works',

            'wri' => 'application/x-mswrite',

            'wrl' => 'x-world/x-vrml',

            'wrz' => 'x-world/x-vrml',

            'xaf' => 'x-world/x-vrml',

            'xbm' => 'image/x-xbitmap',

            'xla' => 'application/vnd.ms-excel',

            'xlc' => 'application/vnd.ms-excel',

            'xlm' => 'application/vnd.ms-excel',

            'xls' => 'application/vnd.ms-excel',

            'xlt' => 'application/vnd.ms-excel',

            'xlw' => 'application/vnd.ms-excel',

            'xof' => 'x-world/x-vrml',

            'xpm' => 'image/x-xpixmap',

            'xwd' => 'image/x-xwindowdump',

            'z' => 'application/x-compress',

            'zip' => 'application/zip',

            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

            'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',

            'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',

            'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',

            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',

            'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',

            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',

            'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',

            'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',

            'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12');

        $ext = pathinfo($filename, PATHINFO_EXTENSION);



        return isset($mimeTypes[$ext]) ? $mimeTypes[$ext] : $default;

    }



    public function setFileContent($content = '') {

        if (strlen($content) == 0) {

            return false;

        }



        // connect db

        $db = Database::getDatabase();



        // load the server the file is on

        $uploadServerDetails = $this->loadFileServer();

        $storageType = $uploadServerDetails['serverType'];



        // get file path

        $fullPath = $this->getFullFilePath();

        $md5File = '';



        // save

        if (($storageType == 'local') || ($storageType == 'direct')) {

            if (file_exists($fullPath)) {

                $rs = file_put_contents($fullPath, $content);

                if ($rs) {

                    // update db

                    $rs = $db->query('UPDATE file '

                            . 'SET fileHash = :fileHash, fileSize = :fileSize '

                            . 'WHERE id = :id', array(

                        'id' => $this->id,

                        'fileHash' => md5_file($fullPath),

                        'fileSize' => filesize($fullPath),

                            )

                    );



                    return true;

                }

            }

        }

        // upload via FTP

        elseif ($storageType == 'ftp') {

            $error = '';



            // connect ftp

            $conn_id = ftp_connect($uploadServerDetails['ipAddress'], $uploadServerDetails['ftpPort'], 30);

            if ($conn_id === false) {

                $error = TranslateHelper::t('classfile_could_not_connect_file_server', 'Could not connect to file server [[[IP_ADDRESS]]]', array('IP_ADDRESS' => $uploadServerDetails['ipAddress']));

            }



            // authenticate

            if (!$error) {

                $login_result = ftp_login($conn_id, $uploadServerDetails['ftpUsername'], $uploadServerDetails['ftpPassword']);

                if ($login_result === false) {

                    $error = TranslateHelper::t('classfile_could_not_authenticate_with_file_server', 'Could not authenticate with file server [[[IP_ADDRESS]]]', array('IP_ADDRESS' => $uploadServerDetails['ipAddress']));

                }

            }



            // upload via ftp

            if (!$error) {

                clearstatcache();



                // temp save image in cache for exif function

                $imageFilename = 'plugins/imageviewer/_tmp/' . md5(microtime() . $this->id) . '.' . $this->extension;

                $tmpFile = CacheHelper::saveCacheToFile($imageFilename, $content);

                if ($tmpFile) {

                    // remove old file

                    ftp_delete($conn_id, $fullPath);



                    // initiate ftp upload

                    $ret = ftp_nb_put($conn_id, $fullPath, $tmpFile, FTP_BINARY, FTP_AUTORESUME);

                    while ($ret == FTP_MOREDATA) {

                        // continue uploading

                        $ret = ftp_nb_continue($conn_id);

                    }



                    if ($ret != FTP_FINISHED) {

                        $error = TranslateHelper::t('classfile_there_was_problem_uploading_file', 'There was a problem uploading the file to [[[IP_ADDRESS]]]', array('IP_ADDRESS' => $uploadServerDetails['ipAddress']));

                    }



                    $fileSize = filesize($tmpFile);

                    $md5File = md5_file($tmpFile);



                    // clear cached file

                    CacheHelper::removeCacheFile($imageFilename);

                }



                // log errors

                if (strlen($error)) {

                    LogHelper::error($error);

                }

                else {

                    // update db

                    if ($fileSize > 0) {

                        $rs = $db->query('UPDATE file '

                                . 'SET fileHash = :fileHash, fileSize = :fileSize '

                                . 'WHERE id = :id', array(

                            'id' => $this->id,

                            'fileHash' => md5_file($md5File),

                            'fileSize' => $fileSize,

                                )

                        );

                    }

                }

            }



            // close ftp connection

            ftp_close($conn_id);

        }

        // upload via Flysystem

        elseif (substr($storageType, 0, 10) == 'flysystem_') {

            $filesystem = FileServerContainerHelper::init($uploadServerDetails['id']);

            if (!$filesystem) {

                $error = TranslateHelper::t('classuploader_could_not_setup_adapter_to_download_file', 'Could not setup adapter to download file.');

            }



            if (!$error) {

                // temp save image in cache for exif function

                $imageFilename = 'plugins/imageviewer/_tmp/' . md5(microtime() . $this->id) . '.' . $this->extension;

                $tmpFile = CacheHelper::saveCacheToFile($imageFilename, $content);

                if ($tmpFile) {

                    try {

                        // remove old file

                        $filesystem->delete($fullPath);



                        // upload file

                        $stream = fopen($tmpFile, 'r+');

                        $rs = $filesystem->writeStream($fullPath, $stream);

                        if (!$rs) {

                            $error = 'Could not upload file. Please contact support or try again.';

                        }

                        else {

                            $fileSize = filesize($tmpFile);

                            $md5File = md5_file($tmpFile);

                        }



                        // clear cached file

                        CacheHelper::removeCacheFile($imageFilename);

                    }

                    catch (Exception $e) {

                        $error = $e->getMessage();

                    }

                }

            }



            // log errors

            if (strlen($error)) {

                log::error($error);

            }

            else {

                // update db

                if ($fileSize > 0) {

                    $rs = $db->query('UPDATE file '

                            . 'SET fileHash = :fileHash, fileSize = :fileSize '

                            . 'WHERE id = :id', array(

                        'id' => $this->id,

                        'fileHash' => $md5File,

                        'fileSize' => $fileSize,

                            )

                    );

                }

            }

        }



        return false;

    }



    static function getKeywordArrFromString($str = '') {

        $str = strtolower($str);



        // remove invalid characters

        $str = str_replace(array('_', '-', '.', ',', '(', ')'), ' ', $str);





        // remove double spaces

        $str = preg_replace('/\s+/', ' ', $str);



        // split apart

        $keywords = explode(' ', $str);



        return $keywords;

    }



    static function getImageExtStringForSql() {

        return '\'' . implode('\',\'', self::getImageExtensionsArr()) . '\'';

    }



    static function createUniqueFileHash($fileId) {

        // load from the db

        $db = Database::getDatabase();



        // create new hash

        $uniqueHash = self::createUniqueFileHashString();



        // update file data

        $db->query('UPDATE file '

                . 'SET unique_hash = :unique_hash '

                . 'WHERE id = :id '

                . 'LIMIT 1', array(

            'unique_hash' => $uniqueHash,

            'id' => (int) $fileId,

        ));



        return $uniqueHash;

    }



    static function createUniqueFileHashString() {

        // load from the db

        $db = Database::getDatabase();



        $uniqueHashFound = true;

        while ($uniqueHashFound == true) {

            $uniqueHash = md5(microtime() . rand(0, 99999)) . md5(microtime() . rand(0, 99999));

            $uniqueHashFound = $db->getValue('SELECT id '

                    . 'FROM file '

                    . 'WHERE unique_hash = :unique_hash '

                    . 'LIMIT 1', array(

                'unique_hash' => $uniqueHash,

            ));

        }



        return $uniqueHash;

    }



    static public function getImageExtensionsArr() {

        // load from image viewer plugin if enabled

        if (PluginHelper::pluginEnabled('imageviewer')) {

            // load plugin details

            $pluginObj = PluginHelper::getInstance('imageviewer');

            $pluginDetails = PluginHelper::pluginSpecificConfiguration('imageviewer');

            $pluginSettings = json_decode($pluginDetails['data']['plugin_settings'], true);



            // look for supported image types

            if ((isset($pluginSettings['supported_image_types'])) && (strlen($pluginSettings['supported_image_types']))) {

                return explode('|', strtolower($pluginSettings['supported_image_types']));

            }

        }



        // fallback

        return explode('|', File::IMAGE_EXTENSIONS);

    }



    static public function checkFileHashBlocked($fileHash) {

        // load from the db

        $db = Database::getDatabase();



        // look for the file block

        return (bool) $db->getValue('SELECT id '

                        . 'FROM file_block_hash '

                        . 'WHERE file_hash = :file_hash '

                        . 'LIMIT 1', array(

                    'file_hash' => $fileHash,

        ));

    }



    static public function showDownloadPages(File $file, $pageTracker = null) {

        // load user

        $Auth = AuthHelper::getAuth();



        // get database

        $db = Database::getDatabase();



        // get total pages

        $maxDownloadPage = (int) $db->getValue('SELECT MAX(page_order) '

                        . 'FROM download_page '

                        . 'WHERE user_level_id = :user_level_id', array(

                    'user_level_id' => $Auth->package_id,

        ));

        if (!$maxDownloadPage) {

            return false;

        }



        // clear any issues in the session left over from previous requests

        if (isset($_SESSION['_download_page_next_page_' . $file->id]) && ((int) $_SESSION['_download_page_next_page_' . $file->id] < 1)) {

            unset($_SESSION['_download_page_next_page_' . $file->id]);

        }



        // check for valid $pageTracker

        if ($pageTracker !== null) {

            $thisPageNumber = (int) self::decodeNextPageHash($pageTracker);

            if ($thisPageNumber != $_SESSION['_download_page_next_page_' . $file->id]) {

                // clear any paging to require $pageTracker token

                $_SESSION['_download_page_wait_' . $file->id] = 0;

                unset($_SESSION['_download_page_next_page_' . $file->id]);

            }

        }

        else {

            unset($_SESSION['_download_page_next_page_' . $file->id]);

        }



        // check if the user is requesting a new file

        if (isset($_SESSION['_download_page_file_id_' . $file->id])) {

            if ($_SESSION['_download_page_file_id_' . $file->id] != $file->id) {

                $_SESSION['_download_page_file_id_' . $file->id] = $file->id;

                $_SESSION['_download_page_wait_' . $file->id] = 0;

                unset($_SESSION['_download_page_next_page_' . $file->id]);

            }

        }



        // next page to show

        if (!isset($_SESSION['_download_page_next_page_' . $file->id])) {

            $_SESSION['_download_page_next_page_' . $file->id] = 1;

            $_SESSION['_download_page_wait_' . $file->id] = 0;

        }



        // make sure we can actually go to the next page, because of waiting periods

        if ($_SESSION['_download_page_wait_' . $file->id] > 0) {

            if ($_SESSION['_download_page_load_time_' . $file->id] >= (time() - (int) $_SESSION['_download_page_wait_' . $file->id])) {

                $_SESSION['_download_page_next_page_' . $file->id] = $_SESSION['_download_page_next_page_' . $file->id] - 1;

                if ($_SESSION['_download_page_next_page_' . $file->id] < 1) {

                    $_SESSION['_download_page_next_page_' . $file->id] = 1;

                }

            }

        }



        // log load time for this page

        $_SESSION['_download_page_load_time_' . $file->id] = time();

        $_SESSION['_download_page_file_id_' . $file->id] = $file->id;

        $_SESSION['_download_page_wait_' . $file->id] = 0;



        $nextOrder = $_SESSION['_download_page_next_page_' . $file->id];



        // load download pages for user level

        $downloadPage = $db->getRow('SELECT download_page, page_order, additional_javascript_code, '

                . 'additional_settings '

                . 'FROM download_page '

                . 'WHERE user_level_id = :user_level_id '

                . 'AND page_order >= :page_order '

                . 'ORDER BY page_order ASC '

                . 'LIMIT 1', array(

            'user_level_id' => (int) $Auth->package_id,

            'page_order' => (int) $nextOrder,

        ));

        if (!$downloadPage) {

            // reset to beginning for next load

            $_SESSION['_download_page_next_page_' . $file->id] = 1;

            $_SESSION['_download_page_wait_' . $file->id] = 0;



            return false;

        }



        $filePath = SITE_TEMPLATES_PATH . '/download_page/' . $downloadPage['download_page'];

        if (!file_exists($filePath)) {

            die('Error: Download page does not exist: ' . $filePath);

        }



        // load additional settings

        $additionalSettings = array();

        if (strlen($downloadPage['additional_settings'])) {

            $additionalSettings = json_decode($downloadPage['additional_settings'], true);

        }



        // set timer wait if exists in the page config

        $_SESSION['_download_page_wait_' . $file->id] = 0;

        if (isset($additionalSettings['download_wait'])) {

            $_SESSION['_download_page_wait_' . $file->id] = (int) $additionalSettings['download_wait'];

        }



        // response with the template path, this is rendered in the controller

        return 'download_page/' . $downloadPage['download_page'];

    }



    static public function makeFilenameSafe($filename) {

        return str_replace(array('"', "\n", "\r", '\''), '', $filename);

    }

}

