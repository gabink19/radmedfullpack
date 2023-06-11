<?php

namespace App\Helpers;

use App\Core\Database;
use App\Libraries\Ip2Country;

class StatsHelper
{
    private static $me;

    public function getStats() {
        if (is_null(self::$me)) {
            self::$me = new Stats();
        }

        return self::$me;
    }

    public static function track($file) {
        $db = Database::getDatabase();

        if (SITE_CONFIG_STATS_ONLY_COUNT_UNIQUE == 'yes') {
            // check whether the user has already visited today
            $sQL = 'SELECT id '
                    . 'FROM stats '
                    . 'WHERE ip = :ip '
                    . 'AND file_id = :file_id '
                    . 'AND DATE(download_date) = :download_date '
                    . 'LIMIT 1';
            $row = $db->getRows($sQL, array(
                'ip' => self::getIP(),
                'file_id' => $file->id,
                'download_date' => date('Y-m-d'),
            ));
            if (COUNT($row)) {
                return false;
            }
        }

        // prep params for later
        $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
        $info = self::browserInfo();
        $userId = null;
        $Auth = AuthHelper::getAuth();
        if ($Auth->loggedIn() === true) {
            $userId = $Auth->id;
        }

        $sQL = 'INSERT INTO stats (download_date, referer, referer_is_local, '
                . 'file_id, country, browser_family, os, ip, user_agent, base_url, '
                . 'user_id) '
                . 'VALUES (:download_date, :referer, :referer_is_local,'
                . ':file_id, :country, :browser_family, :os, :ip, :user_agent, :base_url, '
                . ':user_id)';
        $db->query($sQL, array(
            'download_date' => date("Y-m-d H:i:s"),
            'referer_is_local' => self::refererIsLocal($referer),
            'referer' => $referer,
            'file_id' => $file->id,
            'country' => self::getCountry(self::getIP()),
            'ip' => self::getIP(),
            'browser_family' => $info['browser'],
            'os' => $info['platform'],
            'user_agent' => $info['useragent'],
            'base_url' => self::getBaseUrl($referer),
            'user_id' => $userId,
        ));

        $file->updateVisitors();

        return true;
    }

    public static function refererIsLocal($referer = null) {
        if (is_null($referer)) {
            $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
        }

        if (!strlen($referer)) {
            return 0;
        }

        $regex_host = (preg_quote($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : '');

        return (preg_match("!^https?://$regex_host!i", $referer) !== false) ? 1 : 0;
    }

    public static function getIP() {
        return CoreHelper::getUsersIPAddress();
    }

    // from http://us3.php.net/get_browser comments
    public static function browserInfo($aBrowser = false, $aVersion = false, $name = false) {
        $browserList = 'msie firefox konqueror chrome safari netscape navigator '
                . 'opera mosaic lynx amaya omniweb avant camino flock seamonkey '
                . 'aol mozilla gecko';
        $userBrowser = strtolower($_SERVER["HTTP_USER_AGENT"]);
        $thisVersion = $thisBrowser = '';

        $browserLimit = strlen($userBrowser);
        foreach (explode(' ', $browserList) as $row) {
            $row = ($aBrowser !== false) ? $aBrowser : $row;
            $n = stristr($userBrowser, $row);
            if (!$n || !empty($thisBrowser))
                continue;

            $thisBrowser = $row;
            $j = strpos($userBrowser, $row) + strlen($row) + 1;
            for (; $j <= $browserLimit; $j++) {
                $s = trim(substr($userBrowser, $j, 1));
                $thisVersion .= $s;

                if ($s === '')
                    break;
            }
        }

        if ($aBrowser !== false) {
            $ret = false;
            if (strtolower($aBrowser) == $thisBrowser) {
                $ret = true;

                if ($aVersion !== false && !empty($thisVersion)) {
                    $a_sign = explode(' ', $aVersion);
                    if (version_compare($thisVersion, $a_sign[1], $a_sign[0]) === false) {
                        $ret = false;
                    }
                }
            }

            return $ret;
        }

        $thisPlatform = '';
        if (strpos($userBrowser, 'linux')) {
            $thisPlatform = 'linux';
        }
        elseif (strpos($userBrowser, 'macintosh') || strpos($userBrowser, 'mac platform x')) {
            $thisPlatform = 'mac';
        }
        elseif (strpos($userBrowser, 'windows') || strpos($userBrowser, 'win32')) {
            $thisPlatform = 'windows';
        }

        if ($name !== false) {
            return $thisBrowser . ' ' . $thisVersion;
        }

        return array("browser" => $thisBrowser,
            "version" => $thisVersion,
            "platform" => $thisPlatform,
            "useragent" => $userBrowser
        );
    }

    public static function getCountry($ip) {
        // use new faster class
        $i = new Ip2Country();
        $i->load($ip);
        $country = $i->countryCode;

        // fallback
        if ((strlen($country) == 0) || ($country == '?')) {
            $country = "ZZ";
        }

        return $country;
    }

    public static function getBaseUrl($url) {
        $url = preg_replace("/^http:\/\//", "", $url);
        $url = preg_replace("/^https:\/\//", "", $url);
        $url = preg_replace("/^ftp:\/\//", "", $url);
        $urlTokens = explode("/", $url);

        return $urlTokens[0];
    }

    static function currentBrowserIsIE() {
        if (isset($_SERVER['HTTP_USER_AGENT']) &&
                (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            return true;
        }

        return false;
    }

    static function currentDeviceIsAndroid() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if(stripos($ua, 'Android') !== false) {
            return true;
        }

        return false;
    }

    static function currentDeviceIsIos() {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if(stripos($ua, 'iPhone') !== false) {
            return true;
        }
        
        if(stripos($ua, 'iPad') !== false) {
            return true;
        }
        
        if(stripos($ua, 'iPod') !== false) {
            return true;
        }

        return false;
    }

    static function isDownloadManager($userAgent) {
        $userAgent = trim($userAgent);
        if (strlen($userAgent) == 0) {
            return false;
        }

        $dlUserAgents = 'Charon|DAP |DA |DC-Sakura|Download Demon|Download Druid|Download Express|';
        $dlUserAgents .= 'Download Master|Download Ninja|Download Wonder|DownloadDirect|FDM |FDM/|FileHound|';
        $dlUserAgents .= 'FlashGet|FreshDownload|Gamespy_Arcade|GetRight|GetRightPro|Go!Zilla|HiDownload|';
        $dlUserAgents .= 'HTTPResume|ICOO Loader|iGetter|Iria/|JetCar|JDownloader|Kontiki Client|LeechGet|';
        $dlUserAgents .= 'LightningDownload|Mass Downloader|MetaProducts Download Express|MyGetRight|NetAnts|';
        $dlUserAgents .= 'NetPumper|Nitro Downloader|Octopus|PuxaRapido|RealDownload|SmartDownload|SpeedDownload|';
        $dlUserAgents .= 'SQ Webscanner|Stamina|Star Downloader|StarDownloader|WebReaper|WebStripper|';
        $dlUserAgents .= 'WinGet|WWWOFFLE|wxDownload Fast';
        $dlUserAgentsArr = explode('|', $dlUserAgents);
        foreach ($dlUserAgentsArr AS $dlUserAgent) {
            if (substr($userAgent, 0, strlen($dlUserAgent)) == $dlUserAgent) {
                return true;
            }
        }

        return false;
    }

}
