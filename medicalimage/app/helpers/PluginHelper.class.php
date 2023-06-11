<?php

namespace App\Helpers;

use App\Core\Database;
use App\Helpers\PluginHelper;

class PluginHelper
{
    private static $cssFiles = array();
    private static $jsFiles = array();
    public static $pluginConfigCache = null;
    public static $pluginHookControllerCache = null;

    static function pluginEnabled($pluginKey = '') {
        if ((_CONFIG_DEMO_MODE == true) && (PluginHelper::currentlyInPluginDemoMode() == false)) {
            return false;
        }

        if (strlen($pluginKey) == 0) {
            return false;
        }

        if (self::$pluginConfigCache == null) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        if (!isset(self::$pluginConfigCache[$pluginKey])) {
            return false;
        }

        if (((int) self::$pluginConfigCache[$pluginKey]['data']['plugin_enabled'] == 0) || ((int) self::$pluginConfigCache[$pluginKey]['data']['is_installed'] == 0)) {
            return false;
        }

        return true;
    }

    static function reloadSessionPluginConfig() {
        self::loadPluginConfigurationFiles(true);
    }

    static function pluginSpecificConfiguration($pluginKey = '') {
        if (self::pluginEnabled($pluginKey) == false) {
            return false;
        }

        return self::$pluginConfigCache[$pluginKey];
    }

    static function getPluginConfiguration() {
        return self::$pluginConfigCache;
    }

    static function loadPluginConfigurationFiles($updateCache = false) {
        // try to load from cache
        if ($updateCache == false) {
            if (strlen(SITE_CONFIG_SYSTEM_PLUGIN_CONFIG_CACHE)) {
                self::$pluginConfigCache = @json_decode(SITE_CONFIG_SYSTEM_PLUGIN_CONFIG_CACHE, true);
                if (COUNT(self::$pluginConfigCache)) {
                    return self::$pluginConfigCache;
                }
            }
            else {
                $updateCache = true;
            }
        }

        $rs = array();

        // get active plugins from the db
        $db = Database::getDatabase(true);
        $plugins = $db->getRows('SELECT * '
                . 'FROM plugin '
                . 'WHERE is_installed = 1 '
                . 'ORDER BY load_order ASC');
        if ($plugins) {
            // use output buffering to ensure no random white space is added to the core
            ob_start();
            foreach ($plugins AS $plugin) {
                // load settings
                $pluginConfig = self::getPluginConfigByFolderName($plugin['folder_name']);
                if ($pluginConfig !== false) {
                    $folderName = $pluginConfig->getFolderName();
                    $rs[$folderName] = array();
                    $rs[$folderName]['data'] = $plugin;
                    $rs[$folderName]['config'] = $pluginConfig->getPluginConfig();
                }
            }
            // delete output buffer
            ob_end_clean();
        }

        // save cache
        if ($updateCache == true) {
            self::updatePluginConfigCache($rs);
        }

        return $rs;
    }

    static function updatePluginConfigCache($dataArr) {
        // setup database
        $db = Database::getDatabase();

        // update cache
        $db->query('UPDATE site_config '
                . 'SET config_value=' . $db->quote(json_encode($dataArr)) . ' '
                . 'WHERE config_key = \'system_plugin_config_cache\' '
                . 'LIMIT 1');
        self::$pluginConfigCache = $dataArr;
    }

    static function getInstance($pluginKey) {
        // if no data in session try to reload it
        if (!isset(self::$pluginConfigCache[$pluginKey])) {
            self::reloadSessionPluginConfig();
        }

        // get plugin data
        $plugin = self::$pluginConfigCache[$pluginKey];

        // make sure we have a folder
        if (strlen($plugin['data']['folder_name']) == 0) {
            return false;
        }

        // create plugin instance
        $pluginClassName = '\plugins\\' . $plugin['data']['folder_name'] . '\Plugin' . UCFirst($plugin['data']['folder_name']);
        if(!class_exists($pluginClassName)) {
            return false;
        }

        return new $pluginClassName();
    }

    static function getPluginAdminNav($v2 = false) {
        // add any plugin navigation
        $html = '';
        $pluginConfigs = self::getPluginConfiguration();
        $totalItems = 0;
        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['admin_settings']['top_nav']))) {
                    foreach ($pluginConfig['config']['admin_settings']['top_nav'] AS $navItem) {
                        $html .= '<li';
                        if (ADMIN_SELECTED_PAGE == $navItem[0]['link_key'])
                            $html .= ' class="active"';
                        $html .= '><a';
                        if ($v2 === false) {
                            $html .= ' href="' . ($navItem[0]['link_url'] != '#' ? (PLUGIN_WEB_ROOT . '/' . $pluginConfig['config']['folder_name'] . '/' . $navItem[0]['link_url']) : ($navItem[0]['link_url'])) . '"';
                        }
                        $html .= '>';
                        if ($v2 === true) {
                            $iconClass = 'fa fa-plug';
                            if (isset($navItem[0]['icon_class'])) {
                                $iconClass = $navItem[0]['icon_class'];
                            }
                            $html .= '<i class="' . $iconClass . '"></i> ';
                        }
                        if ($v2 === false) {
                            $html .= '<span>';
                        }
                        $html .= adminFunctions::makeSafe(UCWords(strtolower(adminFunctions::t($navItem[0]['link_text'], $navItem[0]['link_text']))));
                        if ($v2 === false) {
                            $html .= '</span>';
                        }
                        if (($v2 === true) && COUNT($navItem > 1)) {
                            $html .= ' <span class="fa fa-chevron-down"></span>';
                        }
                        $html .= '</a>';

                        if (COUNT($navItem > 1)) {
                            $html .= '<ul';
                            if ($v2 === true) {
                                $html .= ' class="nav child_menu"';
                            }
                            $html .= '>';
                            unset($navItem[0]);
                            foreach ($navItem AS $navSubItem) {
                                $html .= '<li><a href="' . PLUGIN_WEB_ROOT . '/' . $pluginConfig['config']['folder_name'] . '/' . $navSubItem['link_url'] . '">';
                                if ($v2 === false) {
                                    $html .= '<span>';
                                }
                                $html .= adminFunctions::makeSafe(UCWords(strtolower(adminFunctions::t($navSubItem['link_text'], $navSubItem['link_text']))));
                                if ($v2 === false) {
                                    $html .= '</span>';
                                }
                                $html .= '</a>';

                                // add any sub items
                                if (isset($navSubItem['sub_nav'])) {
                                    $html .= '<ul>';
                                    foreach ($navSubItem['sub_nav'] AS $subNavItem) {
                                        $html .= '<li><a href="' . PLUGIN_WEB_ROOT . '/' . $pluginConfig['config']['folder_name'] . '/' . $subNavItem['link_url'] . '">';
                                        if ($v2 === false) {
                                            $html .= '<span>';
                                        }
                                        $html .= adminFunctions::makeSafe(UCWords(strtolower(adminFunctions::t($subNavItem['link_text'], $subNavItem['link_text']))));
                                        if ($v2 === false) {
                                            $html .= '</span>';
                                        }
                                        $html .= '</a></li>';
                                    }
                                    $html .= '</ul>';
                                }

                                $html .= '</li>';
                            }
                            $html .= '</ul>';
                        }
                        $html .= '</li>';

                        $totalItems++;
                    }
                }
            }
        }

        if (($totalItems >= 4) && ($v2 === false)) {
            $html = '<li><a href="#"><span>More...</span><ul>' . $html . '</ul></li>';
        }

        return $html;
    }

    static function getPluginAdminNavDropdown() {
        // add any plugin navigation
        $html = '';
        $pluginConfigs = self::getPluginConfiguration();
        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['admin_settings']['top_nav']))) {
                    foreach ($pluginConfig['config']['admin_settings']['top_nav'] AS $navItem) {
                        $html .= '<optgroup label="' . adminFunctions::makeSafe($navItem[0]['link_text']) . '">';
                        if (COUNT($navItem > 1)) {
                            unset($navItem[0]);
                            foreach ($navItem AS $navSubItem) {
                                $html .= '<option';
                                if ((isset($navSubItem['link_key'])) && defined('ADMIN_SELECTED_SUB_PAGE')) {
                                    if (ADMIN_SELECTED_SUB_PAGE == $navSubItem['link_key']) {
                                        $html .= ' selected';
                                    }
                                }
                                $html .= ' value="' . PLUGIN_WEB_ROOT . '/' . $pluginConfig['config']['folder_name'] . '/' . $navSubItem['link_url'] . '">' . htmlentities(UCWords(strtolower(adminFunctions::t($navSubItem['link_text'], $navSubItem['link_text'])))) . '</option>';
                            }
                        }
                        $html .= '</optgroup>';
                    }
                }
            }
        }

        return $html;
    }

    static function addCssFile($filePath) {
        self::$cssFiles[] = $filePath;
    }

    static function outputCss() {
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        $cssFiles = array();
        foreach (self::$pluginConfigCache AS $pluginConfig) {
            if (self::pluginEnabled($pluginConfig['data']['folder_name'])) {
                $cssFilePath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/assets/css/styles.css';
                if (file_exists($cssFilePath)) {
                    self::addCssFile(PLUGIN_WEB_ROOT . '/' . $pluginConfig['data']['folder_name'] . '/assets/css/styles.css');
                }
            }
        }

        if (COUNT(self::$cssFiles)) {
            // merge and minify css
            //$cachedFilePath = self::mergeCssFiles(self::$cssFiles);
            //if($cachedFilePath !== false)
            //{
            //    self::$cssFiles = array($cachedFilePath);
            //}
            // output css
            foreach (self::$cssFiles AS $cssFile) {
                echo "<link rel=\"stylesheet\" href=\"" . $cssFile . "\" type=\"text/css\" charset=\"utf-8\" />\n";
            }
        }
    }

    static function getMergedBaseFilename($fileListing) {
        return MD5(implode('|', $fileListing));
    }

    static function mergeCssFiles($fileListing = array()) {
        // calculate filename
        $newFileName = self::getMergedBaseFilename($fileListing);

        // get contents
        $fileContentStr = '';
        if (COUNT($fileListing)) {
            foreach ($fileListing AS $filePath) {
                // get contents
                $fileContent = file_get_contents($filePath);
                if (strlen($fileContent)) {
                    $fileContentStr .= "/* " . $filePath . " */\n";
                    $fileContentStr .= $fileContent;
                    $fileContentStr .= "\n";
                }
            }
        }

        // save to file
        $rs = CacheHelper::saveToFileCache($newFileName . '.css', $fileContentStr);
        if ($rs == false) {
            return false;
        }

        return CACHE_WEB_ROOT . '/' . $newFileName . '.css';
    }

    static function outputAdminCss() {
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        $cssFiles = array();
        foreach (self::$pluginConfigCache AS $pluginConfig) {
            if (self::pluginEnabled($pluginConfig['data']['folder_name'])) {
                $cssFilePath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/admin/styles.css';
                if (file_exists($cssFilePath)) {
                    $cssFiles[] = PLUGIN_WEB_ROOT . '/' . $pluginConfig['data']['folder_name'] . '/admin/styles.css';
                }
            }
        }

        if (COUNT($cssFiles)) {
            foreach ($cssFiles AS $cssFile) {
                echo "<link rel=\"stylesheet\" href=\"" . $cssFile . "\" type=\"text/css\" charset=\"utf-8\" />\n";
            }
        }
    }

    static function addJsFile($filePath) {
        self::$jsFiles[] = $filePath;
    }

    static function outputJs() {
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        $jsFiles = array();
        foreach (self::$pluginConfigCache AS $pluginConfig) {
            if (self::pluginEnabled($pluginConfig['data']['folder_name'])) {
                $jsFilePath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/assets/js/plugin.js';
                if (file_exists($jsFilePath)) {
                    self::addJsFile(PLUGIN_WEB_ROOT . '/' . $pluginConfig['data']['folder_name'] . '/assets/js/plugin.js');
                }
            }
        }

        if (COUNT(self::$jsFiles)) {
            // disabled as it can cause issues with paths. Recommend using a service like CloudFlaire instead
            //if (SITE_CONFIG_PERFORMANCE_JS_FILE_MINIFY == 'yes')
            //{
            //    // merge and minify js
            //    $cachedFilePath = self::mergeJsFiles(self::$jsFiles);
            //    if ($cachedFilePath !== false)
            //    {
            //        self::$jsFiles = array($cachedFilePath);
            //    }
            ///}

            foreach (self::$jsFiles AS $jsFile) {
                echo "<script type=\"text/javascript\" src=\"" . $jsFile . "\"></script>\n";
            }
        }
    }

    static function mergeJsFiles($fileListing = array()) {
        // calculate filename
        $newFileName = self::getMergedBaseFilename($fileListing);
        $jsSubFilePath = CACHE_DIRECTORY_ROOT . '/js';
        $fullCacheFilePath = $jsSubFilePath . '/' . $newFileName . '.js';
        $fullCacheWebPath = CACHE_WEB_ROOT . '/js/' . $newFileName . '.js';
        if (file_exists($fullCacheFilePath)) {
            return $fullCacheWebPath;
        }

        // get contents
        $fileContentStr = '';
        if (COUNT($fileListing)) {
            foreach ($fileListing AS $filePath) {
                // get contents
                $fileContent = file_get_contents($filePath);
                if (strlen($fileContent)) {
                    $fileContentStr .= "// " . $filePath . "\n";
                    $fileContentStr .= $fileContent;
                    $fileContentStr .= "\n";
                }
            }
        }

        // minify js before saving
        $rs = self::minifyJS($fileContentStr);
        if ($rs) {
            $fileContentStr = $rs;
        }

        // make sure sub folder exists
        if (!is_dir($jsSubPath)) {
            @mkdir($jsSubFilePath);
        }

        // save to file
        $rs = file_put_contents($fullCacheFilePath, $fileContentStr);
        if ($rs == false) {
            return false;
        }

        return $fullCacheWebPath;
    }

    static function minifyJS($fileContent) {
        return \JShrink\Minifier::minify($fileContent);
    }

    static function outputAdminJs() {
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        $jsFiles = array();
        foreach (self::$pluginConfigCache AS $pluginConfig) {
            if (self::pluginEnabled($pluginConfig['data']['folder_name'])) {
                $jsFilePath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/admin/plugin.js';
                if (file_exists($jsFilePath)) {
                    $jsFiles[] = PLUGIN_WEB_ROOT . '/' . $pluginConfig['data']['folder_name'] . '/admin/plugin.js';
                }
            }
        }

        if (COUNT($jsFiles)) {
            foreach ($jsFiles AS $jsFile) {
                echo "<script type=\"text/javascript\" src=\"" . $jsFile . "\"></script>\n";
            }
        }
    }

    static function includeAppends($fileName, $params = null) {
        // disabled as rewritten to PluginHelper::callHook
        return $params;

        $originalParams = $params;
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        $includesFiles = array();
        foreach (self::$pluginConfigCache AS $pluginConfig) {
            $includesFilePath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/includes/_append_' . $fileName;
            if ((file_exists($includesFilePath)) && (self::pluginEnabled($pluginConfig['data']['folder_name']) == true)) {
                $includesFiles[] = $includesFilePath;
            }
        }

        if (COUNT($includesFiles)) {
            foreach ($includesFiles AS $includesFile) {
                include($includesFile);
            }
        }

        return $params;
    }

    static function outputPaymentLinks($params = null) {
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        $includesFiles = array();
        foreach (self::$pluginConfigCache AS $pluginConfig) {
            $includesFilePath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/includes/_append_upgradeBoxes.inc.php';
            if ((file_exists($includesFilePath)) && (self::pluginEnabled($pluginConfig['data']['folder_name']) == true)) {
                $includesFiles[] = $includesFilePath;
            }
        }

        if (COUNT($includesFiles)) {
            $days = $params['days'];
            $price = $params['price'];
            foreach ($includesFiles AS $includesFile) {
                include($includesFile);
            }
        }
    }

    static function generateHeaderNavStructure($baseNavigation, $userLevelId = 0) {
        // add any plugin navigation
        $pluginConfigs = self::getPluginConfiguration();
        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['site_settings']['top_nav']))) {
                    foreach ($pluginConfig['config']['site_settings']['top_nav'] AS $k => $navItem) {
                        $baseNavigation[$k] = $navItem;
                    }
                }
            }
        }

        // filter any not valid for this user level id
        $navItems = array();
        foreach ($baseNavigation AS $k => $baseNavigationItem) {
            if (in_array($userLevelId, $baseNavigationItem['user_level_id'])) {
                $navItems[$k] = $baseNavigationItem;
            }
        }

        // sort according to 'position'
        usort($navItems, array('PluginHelper', 'sortByOrder'));

        return $navItems;
    }

    static function sortByOrder($a, $b) {
        return $a['position'] - $b['position'];
    }

    static function currentlyInPluginDemoMode() {
        if (self::demoPluginsEnabled()) {
            return false;
        }

        if (_CONFIG_DEMO_MODE == false) {
            return false;
        }

        return true;
    }

    static function demoPluginsEnabled() {
        if (!isset($_SESSION['_plugins'])) {
            return false;
        }

        if ($_SESSION['_plugins'] == false) {
            return false;
        }

        return true;
    }

    static function getPluginAdminPackageSettingsForm($packageId = null) {
        // setup database
        $db = Database::getDatabase();

        // add any plugin navigation
        $html = '';
        $pluginConfigs = self::getPluginConfiguration();
        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['package_options']))) {
                    $html .= '<strong>' . $pluginConfig['config']['plugin_name'] . ' Plugin:<br/><br/></strong>';
                    $html .= '<div class="form">';
                    $class = 'alt-highlight';
                    foreach ($pluginConfig['config']['package_options'] AS $formItem) {
                        $value = $formItem['default_value'];

                        // try to load any existing values
                        if ((int) $packageId) {
                            $existingData = $db->getValue('SELECT plugin_settings FROM plugin WHERE id = ' . (int) $pluginConfig['data']['id'] . ' LIMIT 1');
                            if ($existingData) {
                                $existingDataArr = json_decode($existingData, true);
                                if (is_array($existingDataArr)) {
                                    if (isset($existingDataArr['account_packages'])) {
                                        if (isset($existingDataArr['account_packages']['package_' . $packageId])) {
                                            $fieldName = $formItem['field_name'];
                                            if (isset($existingDataArr['account_packages']['package_' . $packageId][$fieldName])) {
                                                $value = $existingDataArr['account_packages']['package_' . $packageId][$fieldName];
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $html .= '<div class="clearfix ' . $class . '">
										<label>' . adminFunctions::makeSafe(UCWords($formItem['field_label'])) . ':</label>
										<div class="input">';
                        switch ($formItem['field_type']) {
                            case 'integer':
                                $element = '<input type="text" value="' . adminFunctions::makeSafe($value) . '" class="custom[integer]" name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '"/>';
                                break;
                            case 'select':
                                $selectItems = array();
                                $availableValues = $formItem['available_values'];
                                if (substr($availableValues, 0, 6) == 'SELECT') {
                                    $items = $db->getRows($availableValues);
                                    if ($items) {
                                        foreach ($items AS $item) {
                                            $selectItems[] = $item['itemValue'];
                                        }
                                    }
                                }
                                else {
                                    $selectItems = json_decode($availableValues, true);
                                    if (COUNT($selectItems) == 0) {
                                        $selectItems = array('Error: Failed loading options');
                                    }
                                }

                                $element = '<select name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '">';
                                foreach ($selectItems AS $selectItem) {
                                    $element .= '<option value="' . adminFunctions::makeSafe($selectItem) . '"';
                                    if ($selectItem == $value) {
                                        $element .= ' SELECTED';
                                    }
                                    $element .= '>' . adminFunctions::makeSafe($selectItem) . '</option>';
                                }
                                $element .= '</select>';
                                break;
                            case 'string':
                                $element = '<input type="text" value="' . adminFunctions::makeSafe($value) . '" class="large" name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '"/>';
                                break;
                            case 'textarea':
                            default:
                                $element = '<textarea class="xxlarge" name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '">' . adminFunctions::makeSafe($value) . '</textarea>';
                                break;
                        }

                        $html .= $element;
                        if (strlen($formItem['field_description'])) {
                            $html .= '&nbsp;&nbsp;' . adminFunctions::makeSafe($formItem['field_description']);
                        }
                        $html .= '		</div>
									</div>';

                        // row formatting
                        if ($class == 'alt-highlight') {
                            $class = '';
                        }
                        else {
                            $class = 'alt-highlight';
                        }
                    }
                    $html .= '</div><br/>';
                }
            }
        }

        return $html;
    }

    static function getPluginAdminPackageSettingsFormV2($packageId = null) {
        // setup database
        $db = Database::getDatabase();

        // add any plugin navigation
        $html = '';
        $pluginConfigs = self::getPluginConfiguration();
        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['package_options']))) {
                    $html .= '<h2>' . $pluginConfig['config']['plugin_name'] . ' Plugin:</h2><br/>';
                    $html .= '<div class="form">';
                    foreach ($pluginConfig['config']['package_options'] AS $formItem) {
                        $value = $formItem['default_value'];

                        // try to load any existing values
                        if ((int) $packageId) {
                            $existingData = $db->getValue('SELECT plugin_settings FROM plugin WHERE id = ' . (int) $pluginConfig['data']['id'] . ' LIMIT 1');
                            if ($existingData) {
                                $existingDataArr = json_decode($existingData, true);
                                if (is_array($existingDataArr)) {
                                    if (isset($existingDataArr['account_packages'])) {
                                        if (isset($existingDataArr['account_packages']['package_' . $packageId])) {
                                            $fieldName = $formItem['field_name'];
                                            if (isset($existingDataArr['account_packages']['package_' . $packageId][$fieldName])) {
                                                $value = $existingDataArr['account_packages']['package_' . $packageId][$fieldName];
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $html .= '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . adminFunctions::makeSafe(UCWords($formItem['field_label'])) . ':</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">';
                        switch ($formItem['field_type']) {
                            case 'integer':
                                $element = '<input type="text" value="' . adminFunctions::makeSafe($value) . '" class="form-control" name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '"/>';
                                break;
                            case 'select':
                                $selectItems = array();
                                $availableValues = $formItem['available_values'];
                                if (substr($availableValues, 0, 6) == 'SELECT') {
                                    $items = $db->getRows($availableValues);
                                    if ($items) {
                                        foreach ($items AS $item) {
                                            $selectItems[] = $item['itemValue'];
                                        }
                                    }
                                }
                                else {
                                    $selectItems = json_decode($availableValues, true);
                                    if (COUNT($selectItems) == 0) {
                                        $selectItems = array('Error: Failed loading options');
                                    }
                                }

                                $element = '<select name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '" class="form-control">';
                                foreach ($selectItems AS $selectItem) {
                                    $element .= '<option value="' . adminFunctions::makeSafe($selectItem) . '"';
                                    if ($selectItem == $value) {
                                        $element .= ' SELECTED';
                                    }
                                    $element .= '>' . adminFunctions::makeSafe($selectItem) . '</option>';
                                }
                                $element .= '</select>';
                                break;
                            case 'string':
                                $element = '<input type="text" value="' . adminFunctions::makeSafe($value) . '" class="form-control" name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '"/>';
                                break;
                            case 'textarea':
                            default:
                                $element = '<textarea class="form-control" name="plugin_' . adminFunctions::makeSafe($pluginConfig['config']['folder_name']) . '_' . adminFunctions::makeSafe($formItem['field_name']) . '" id="' . adminFunctions::makeSafe($formItem['field_name']) . '">' . adminFunctions::makeSafe($value) . '</textarea>';
                                break;
                        }

                        $html .= $element;
                        if (strlen($formItem['field_description'])) {
                            $html .= '<p class="text-muted">' . adminFunctions::makeSafe($formItem['field_description']) . '</p>';
                        }
                        $html .= '		</div>
									</div>';

                        // row formatting
                        if ($class == 'alt-highlight') {
                            $class = '';
                        }
                        else {
                            $class = 'alt-highlight';
                        }
                    }
                    $html .= '</div><br/>';
                }
            }
        }

        return $html;
    }

    static function updatePluginPackageSettings($data, $packageId) {
        // setup database
        $db = Database::getDatabase();

        // add any plugin navigation
        $html = '';
        $pluginConfigs = self::getPluginConfiguration();
        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['package_options']))) {
                    $newSettingsData = array();
                    foreach ($data AS $k => $dataItem) {
                        if (substr($k, 0, strlen('plugin_' . $pluginConfig['data']['folder_name'] . '_')) == 'plugin_' . $pluginConfig['data']['folder_name'] . '_') {
                            $actualName = substr($k, strlen('plugin_' . $pluginConfig['data']['folder_name'] . '_'));
                            $newSettingsData[$actualName] = $dataItem;
                        }
                    }

                    // if we have new data, update the db
                    if (COUNT($newSettingsData)) {
                        $existingData = $db->getValue('SELECT plugin_settings FROM plugin WHERE id = ' . (int) $pluginConfig['data']['id'] . ' LIMIT 1');
                        if ($existingData) {
                            $existingDataArr = json_decode($existingData, true);
                            if (is_array($existingDataArr)) {
                                // add new data
                                $existingDataArr['account_packages']['package_' . $packageId] = $newSettingsData;

                                // update the db
                                $db->query('UPDATE plugin SET plugin_settings = ' . $db->quote(json_encode($existingDataArr)) . ' WHERE id = ' . (int) $pluginConfig['data']['id'] . ' LIMIT 1');
                            }
                        }
                    }
                }
            }
        }

        // reload plugin settings
        self::reloadSessionPluginConfig();

        return true;
    }

    public static function getPluginAdminNavV2() {
        return self::getPluginAdminNav(true);
    }

    public static function getAllPluginRoutes() {
        $pluginRoutes = array();
        $pluginConfigs = self::getPluginConfiguration();

        if (COUNT($pluginConfigs)) {
            foreach ($pluginConfigs AS $pluginConfig) {
                if ((self::pluginEnabled($pluginConfig['data']['folder_name']) == 1) && (isset($pluginConfig['config']['routes']))) {
                    foreach ($pluginConfig['config']['routes'] AS $k => $v) {
                        $pluginRoutes[$k] = $v;
                    }
                }
            }
        }

        return $pluginRoutes;
    }

    public static function handlePluginRoute($url) {
        $pluginRoutes = self::getAllPluginRoutes();
        foreach ($pluginRoutes AS $pluginRoute => $realPath) {
            if (preg_match('/^' . $pluginRoute . '/', $url)) {
                require_once(PLUGIN_DIRECTORY_ROOT . $realPath);
                exit;
            }
        }

        return false;
    }

    public static function registerRoutes(\FastRoute\RouteCollector $r) {
        // get all enabled and installed plugins
        $pluginConfigs = self::getPluginConfiguration();
        if ($pluginConfigs) {
            foreach ($pluginConfigs AS $pluginKey => $pluginConfig) {
                // instantiate the plugin
                $pluginInstance = self::getInstance($pluginKey);
                if(!$pluginInstance) {
                    continue;
                }

                // register routes
                $pluginInstance->registerRoutes($r);
            }
        }
    }

    static function callHook($hookStr, $params = null) {
        self::registerHookControllers();

        if (count(self::$pluginHookControllerCache)) {
            foreach (self::$pluginHookControllerCache AS $pluginHookController) {
                // check to see if hookStr exists as method on class
                if (method_exists($pluginHookController, $hookStr)) {
                    // if it exists, call it with our params
                    $controllerClass = new $pluginHookController;
                    $rs = call_user_func(array($controllerClass, $hookStr), $params);
                    // handle response
                    // array responses are assumed an overwrite of the $params
                    if (is_array($rs)) {
                        $params = $rs;
                    }
                    // "Response" object
                    elseif (is_object($rs)) {
                        // return the object
                        return $rs;
                    }
                }
            }
        }

        return $params;
    }

    /**
     * Use to render the Response of a hook directly into Twig templates or to
     * return the rendered HTML in a one-liner.
     * {{ PluginHelper.outputHook('loginLoginBox') }}
     * 
     * @param type $hookStr
     * @param type $params
     * @return string
     */
    static function outputHook($hookStr, $params = null) {
        // process the hook
        $rs = self::callHook($hookStr, $params);

        // if we have a response object, just return the html
        if (is_object($rs)) {
            $reflect = new \ReflectionClass($rs);
            if ($reflect->getShortName() === 'Response') {
                return $rs->getContent();
            }
        }

        return '';
    }

    static function registerHookControllers() {
        if (!isset(self::$pluginConfigCache)) {
            self::$pluginConfigCache = self::loadPluginConfigurationFiles();
        }

        if (self::$pluginHookControllerCache !== null) {
            return;
        }

        // get all enabled and installed plugins
        self::$pluginHookControllerCache = array();
        $pluginConfigs = self::getPluginConfiguration();
        if ($pluginConfigs) {
            foreach ($pluginConfigs AS $pluginKey => $pluginConfig) {
                // instantiate the plugin
                $pluginInstance = self::getInstance($pluginKey);
                if(!$pluginInstance) {
                    continue;
                }

                // see if there's a Hooks controller
                $hooksController = $pluginInstance->getHooksControllerName();

                // check for the class
                $hooksControllerPath = PLUGIN_DIRECTORY_ROOT . $pluginConfig['data']['folder_name'] . '/controllers/' . $hooksController . '.class.php';
                if (file_exists($hooksControllerPath)) {
                    $className = '\Plugins\\' . ucfirst(str_replace(array(' ', '_', '-'), '', $pluginConfig['data']['folder_name'])) . '\Controllers\\' . $hooksController;
                    self::$pluginHookControllerCache[] = $className;
                }
            }
        }
    }

    static function getPluginConfigByFolderName($pluginFolderName) {
        // create plugin config instance
        $pluginConfigClassName = '\plugins\\' . $pluginFolderName . '\PluginConfig';
        if (!class_exists($pluginConfigClassName)) {
            return false;
        }

        return new $pluginConfigClassName();
    }

}
