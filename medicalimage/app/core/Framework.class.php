<?php

namespace App\Core;

use App\Core\Database;
use App\Helpers\BannedIpHelper;
use App\Helpers\CoreHelper;
use App\Helpers\PluginHelper;
use App\Helpers\LogHelper;
use App\Helpers\RouteHelper;
use App\Helpers\SessionHelper;

class Framework
{
    const VERSION_NUMBER = '2.0.1';

    public static function run() {
        self::init();
        self::autoload();
        LogHelper::initErrorHandler();
        self::registerSession();
        self::postInit();
        self::dispatch();
    }

    public static function runLight() {
        self::init();
        self::autoload();
    }

    // initialization
    private static function init() {

        // define path constants
        define('DS', DIRECTORY_SEPARATOR);

        // determine our absolute document root
        define('DOC_ROOT', realpath(dirname(__FILE__) . '/../../'));
        define('APP_ROOT', DOC_ROOT . '/app');
        define('CORE_FRAMEWORK_ROOT', APP_ROOT . '/core');
        define('CORE_FRAMEWORK_HELPERS_ROOT', APP_ROOT . '/helpers');
        define('CORE_FRAMEWORK_LIBRARIES_ROOT', APP_ROOT . '/libraries');
        define('CORE_APPLICATION_CONTROLLERS_ROOT', APP_ROOT . '/controllers');
        define('CORE_APPLICATION_TEMPLATES_PATH', APP_ROOT . '/views');
        define('CORE_FRAMEWORK_SERVICES_ROOT', APP_ROOT . '/services');
        define('LOCAL_SITE_CONFIG_BASE_LOG_PATH', DOC_ROOT . '/logs/');

        // include config
        require DOC_ROOT . '/_config.inc.php';

        // set timezone if not set, change to whatever timezone you want
        if (!ini_get('date.timezone')) {
            date_default_timezone_set('GMT');
        }

        // setup php values
        self::iniSets();

        // set local paths
        define('WEB_ROOT', _CONFIG_SITE_PROTOCOL . '://' . _CONFIG_SITE_FULL_URL);
        define('CORE_WEB_ROOT', _CONFIG_SITE_PROTOCOL . '://' . _CONFIG_CORE_SITE_FULL_URL);

        // core classes
        include_once CORE_FRAMEWORK_ROOT . '/Database.class.php';
        include_once CORE_FRAMEWORK_ROOT . '/BaseController.class.php';
        include_once CORE_FRAMEWORK_ROOT . '/Auth.class.php';

        // load site config
        self::initConfigIntoMemory();

        // the root plugin directory
        define('PLUGIN_DIRECTORY_NAME', 'plugins');
        define('PLUGIN_DIRECTORY_ROOT', DOC_ROOT . '/' . PLUGIN_DIRECTORY_NAME . '/');
        define('PLUGIN_WEB_ROOT', WEB_ROOT . '/' . PLUGIN_DIRECTORY_NAME);

        // path to core ajax files
        define('CORE_APPLICATION_WEB_ROOT', WEB_ROOT . '');

        // how often to update the download tracker in seconds.
        define('DOWNLOAD_TRACKER_UPDATE_FREQUENCY', 15);

        // how long to keep the download tracker data, in days
        define('DOWNLOAD_TRACKER_PURGE_PERIOD', 7);

        // admin paths
        define('ADMIN_FOLDER_NAME', 'admin');
        define('ADMIN_WEB_ROOT', WEB_ROOT . '/' . ADMIN_FOLDER_NAME);

        // account paths
        define('ACCOUNT_WEB_ROOT', WEB_ROOT . '/account');

        // cache store
        define('CACHE_DIRECTORY_NAME', 'cache');
        define('CACHE_DIRECTORY_ROOT', DOC_ROOT . '/' . CACHE_DIRECTORY_NAME);
        define('CACHE_WEB_ROOT', WEB_ROOT . '/' . CACHE_DIRECTORY_NAME);

        // theme paths
        define('SITE_THEME_DIRECTORY_NAME', 'themes');
        define('SITE_THEME_DIRECTORY_ROOT', DOC_ROOT . '/' . SITE_THEME_DIRECTORY_NAME . '/');
        define('SITE_THEME_WEB_ROOT', WEB_ROOT . '/' . SITE_THEME_DIRECTORY_NAME . '/');

        // non theme assets
        define('CORE_ASSETS_WEB_ROOT', CORE_APPLICATION_WEB_ROOT . '/app/assets');
        define('CORE_ASSETS_ADMIN_WEB_ROOT', CORE_ASSETS_WEB_ROOT . '/admin');
        define('CORE_ASSETS_ADMIN_DIRECTORY_ROOT', APP_ROOT . '/assets/admin');
    }

    private static function postInit() {
        // whether to show the maintenance page
        CoreHelper::checkMaintenanceMode(_INT_PAGE_URL);

        // get database connection
        $db = Database::getDatabase();

        // whether to use language specific images
        $languageImagePath = '';
        $languageDirection = 'LTR';
        $languageDetails = $db->getRow("SELECT id, flag, direction "
                . "FROM language "
                . "WHERE isActive = 1 "
                . "AND languageName = " . $db->quote($_SESSION['_t']) . " "
                . "LIMIT 1");
        if ($languageDetails) {
            $languageDirection = $languageDetails['direction'];
            if (SITE_CONFIG_LANGUAGE_SEPARATE_LANGUAGE_IMAGES == 'yes') {
                $languageImagePath = $languageDetails['flag'] . '/';
            }
            define('SITE_CURRENT_LANGUAGE_ID', (int) $languageDetails['id']);
        }

        // language
        define('SITE_LANGUAGE_DIRECTION', $languageDirection);

        // theme paths
        $siteTheme = SITE_CONFIG_SITE_THEME;
        if ((isset($_SESSION['_current_theme'])) && (strlen($_SESSION['_current_theme']))) {
            $siteTheme = $_SESSION['_current_theme'];
        }

        define('SITE_CURRENT_THEME_DIRECTORY_ROOT', SITE_THEME_DIRECTORY_ROOT . $siteTheme);
        define('SITE_IMAGE_DIRECTORY_ROOT', SITE_CURRENT_THEME_DIRECTORY_ROOT . '/assets/' . $languageImagePath . 'images');
        define('SITE_CSS_DIRECTORY_ROOT', SITE_CURRENT_THEME_DIRECTORY_ROOT . '/assets/' . $languageImagePath . 'styles');
        define('SITE_JS_DIRECTORY_ROOT', SITE_CURRENT_THEME_DIRECTORY_ROOT . '/assets/' . $languageImagePath . 'js');
        define('SITE_TEMPLATES_PATH', SITE_CURRENT_THEME_DIRECTORY_ROOT . '/views');

        define('SITE_THEME_PATH', SITE_THEME_WEB_ROOT . $siteTheme);
        define('SITE_IMAGE_PATH', SITE_THEME_PATH . '/assets/' . $languageImagePath . 'images');
        define('SITE_CSS_PATH', SITE_THEME_PATH . '/assets/' . $languageImagePath . 'styles');
        define('SITE_JS_PATH', SITE_THEME_PATH . '/assets/' . $languageImagePath . 'js');

        // check for banned ip
        $bannedIP = BannedIpHelper::getBannedType();
        if (strtolower($bannedIP) === "whole site") {
            header('HTTP/1.1 404 Not Found');
            die();
        }

        // load old user level constants
        CoreHelper::setupOldPaymentConstants();

        // setup demo mode
        if (_CONFIG_DEMO_MODE == true) {
            if (isset($_REQUEST['_p'])) {
                $_SESSION['_plugins'] = false;
                if ((int) $_REQUEST['_p'] == 1) {
                    $_SESSION['_plugins'] = true;
                }
                PluginHelper::loadPluginConfigurationFiles(true);
            }

            if (!isset($_SESSION['_plugins'])) {
                $_SESSION['_plugins'] = false;
                PluginHelper::loadPluginConfigurationFiles(true);
            }
        }

        // load plugin configuration
        PluginHelper::loadPluginConfigurationFiles();
    }

    private static function iniSets() {
        // increase allocated memory
        @ini_set('memory_limit', '512M');
    }

    private static function registerSession() {
        if(SITE_CONFIG_USER_SESSION_TYPE === 'Database Sessions') {
            // store session info in the database
            SessionHelper::register();
        }
        
        // initialize our session
        session_name('filehosting');

        // how long to keep sessions active before expiring
        session_set_cookie_params((int) SITE_CONFIG_SESSION_EXPIRY);

        // start session
        session_start();
    }

    // autoloading
    private static function autoload() {
        // register application autoloads
        spl_autoload_register(array(__CLASS__, 'load'));

        // register composer autoloads
        require_once(APP_ROOT . '/libraries/vendor/autoload.php');
    }

    // define a custom load method
    private static function load($className) {
        // autoload classes here
        $className = basename($className);

        // new class loading method via namespaces, update the above
        $className = str_replace('\\', DS, $className);
        $filename = basename($className) . '.class.php';

        // make path lowercase as our folders are all lowercase
        $className = strtolower(dirname($className)) . DS . $filename;

        // make sure the path is lowercase and the filename upper
        if (file_exists(DOC_ROOT . DS . $className)) {
            require_once(DOC_ROOT . DS . $className);
            return;
        }
        else {
            // if this is a helper class, auto load it
            $error = 'Error: Could not auto load class: ' . $className . '<br/><br/>Ensure you\'ve set a "use" statement at the top of your code.<br/><br/>';
            $e = new \Exception();
            $error .= nl2br($e->getTraceAsString());
        }
    }

    // routing and dispatching
    private static function dispatch() {
        // process routes
        RouteHelper::processRoutes();
    }

    private static function initConfigIntoMemory() {
        // load db config settings into constants
        $db = Database::getDatabase();
        $rows = $db->getRows('SELECT config_key, config_value '
                . 'FROM site_config '
                . 'ORDER BY config_group, config_key');
        if (COUNT($rows)) {
            foreach ($rows AS $row) {
                $constantName = 'SITE_CONFIG_' . strtoupper($row['config_key']);
                if (!defined($constantName)) {
                    define($constantName, $row['config_value']);
                }
            }
        }
    }

}
