<?php
namespace Themes\Evolution;

use App\Models\File;
use App\Core\Database;
use App\Helpers\CoreHelper;
use App\Helpers\ThemeHelper;
use App\Services\Theme;
use Themes\Evolution\ThemeConfig;

class ThemeEvolution extends Theme
{
    public function __construct() {
        // load theme config
        $this->config = (new ThemeConfig())->getThemeConfig();
    }
    
    public function registerRoutes(\FastRoute\RouteCollector $r) {
        // register any theme routes
        $r->addRoute(['GET', 'POST'], '/'.ADMIN_FOLDER_NAME.'/theme_settings/'.$this->config['folder_name'], '\themes\\'.$this->config['folder_name'].'\controllers\admin\ThemeController/themeSettings');
    }

    public function getThemeDetails() {
        return $this->config;
    }

    public function getThemeSkin() {
        $skin = ThemeHelper::getConfigValue('site_skin');
        if (strlen($skin)) {
            return $skin;
        }

        return false;
    }

    public function getMainLogoUrl() {
        // get database
        $db = Database::getDatabase();

        // see if the replaced logo exists
        $localCachePath = CACHE_DIRECTORY_ROOT . '/themes/' . $this->config['folder_name'] . '/logo.png';
        if (file_exists($localCachePath)) {
            return CACHE_WEB_ROOT . '/themes/' . $this->config['folder_name'] . '/logo.png';
        }

        return $this->getFallbackMainLogoUrl();
    }

    public function getFallbackMainLogoUrl() {
        return CoreHelper::getCoreSitePath() . '/themes/' . $this->config['folder_name'] . '/assets/images/logo/logo.png';
    }

    public function getInverseLogoUrl() {
        // get database
        $db = Database::getDatabase();

        // see if the replaced logo exists
        $localCachePath = CACHE_DIRECTORY_ROOT . '/themes/' . $this->config['folder_name'] . '/logo_inverse.png';
        if (file_exists($localCachePath)) {
            return CACHE_WEB_ROOT . '/themes/' . $this->config['folder_name'] . '/logo_inverse.png';
        }

        return $this->getInverseFallbackLogoUrl();
    }

    public function getInverseFallbackLogoUrl() {
        return CoreHelper::getCoreSitePath() . '/themes/' . $this->config['folder_name'] . '/assets/images/logo/logo-whitebg.png';
    }

    public function outputCustomCSSCode() {
        // see if the replaced logo exists
        $localCachePath = CACHE_DIRECTORY_ROOT . '/themes/' . $this->config['folder_name'] . '/custom_css.css';
        if (file_exists($localCachePath)) {
            return "<link href=\"" . CACHE_WEB_ROOT . "/themes/" . $this->config['folder_name'] . "/custom_css.css?r=" . md5(microtime()) . "\" rel=\"stylesheet\">\n";
        }
    }

    public function getCustomCSSCode() {
        return ThemeHelper::getConfigValue('css_code');
    }

    public function getSimilarFiles(File $file) {
        $similarFiles = array();

        // load database
        $db = Database::getDatabase(true);

        // load orderby from session
        $orderBy = 'originalFilename';
        if (isset($_SESSION['search']['filterOrderBy'])) {
            $orderBy = $_SESSION['search']['filterOrderBy'];
        }
        
        // if this is a shared file (at file level), ensure we don't show the rest
        // of the folder files unless the user has access
        $isDirectSharedFile = false;
        if(isset($_SESSION['sharekeyFile' . $file->id])) {
            $isDirectSharedFile = true;
        }

        // get all other files in the same folder/album, only if this file is in an actual folder
        if ((int) $file->folderId) {
            $similarFiles = $db->getRows('SELECT * '
                    . 'FROM file '
                    . 'WHERE folderId = :folderId '
                    . 'AND status = "active" '
                    . 'ORDER BY ' . $this->convertSortOption($orderBy).' '
                    . 'LIMIT 200', array(
                'folderId' => (int) $file->folderId,
            ));
        }
        elseif ((int) $file->userId) {
            $similarFiles = $db->getRows('SELECT * '
                    . 'FROM file '
                    . 'WHERE userId = :userId '
                    . 'AND folderId IS NULL '
                    . 'AND status = "active" '
                    . 'ORDER BY ' . $this->convertSortOption($orderBy).' '
                    . 'LIMIT 200', array(
                'userId' => (int) $file->userId,
            ));
        }

        if (!is_array($similarFiles)) {
            return array();
        }

        if (!COUNT($similarFiles)) {
            return array();
        }

        // set the currently selected on as the first
        $startArr = array();
        $endArr = array();
        $found = false;
        $rsArr = array();
        foreach ($similarFiles AS $similarFile) {
            // double check the user is allowed access
            if($isDirectSharedFile === true) {
                if(!CoreHelper::getOverallPublicStatus($similarFile['userId'], $similarFile['folderId'], $similarFile['id'])) {
                    continue;
                }
            }
            
            // load the file object for the response
            $file = File::hydrateSingleRecord($similarFile);
            $rsArr[] = $file;
        }

        return $rsArr;
    }

    public function convertSortOption($filterOrderBy) {
        $sortColName = 'originalFilename asc';
        switch ($filterOrderBy) {
            case 'order_by_filename_asc':
                $sortColName = 'originalFilename asc';
                break;
            case 'order_by_filename_desc':
                $sortColName = 'originalFilename desc';
                break;
            case 'order_by_uploaded_date_asc':
            case '':
                $sortColName = 'uploadedDate asc';
                break;
            case 'order_by_uploaded_date_desc':
                $sortColName = 'uploadedDate desc';
                break;
            case 'order_by_downloads_asc':
                $sortColName = 'visits asc';
                break;
            case 'order_by_downloads_desc':
                $sortColName = 'visits desc';
                break;
            case 'order_by_filesize_asc':
                $sortColName = 'fileSize asc';
                break;
            case 'order_by_filesize_desc':
                $sortColName = 'fileSize desc';
                break;
            case 'order_by_last_access_date_asc':
                $sortColName = 'lastAccessed asc';
                break;
            case 'order_by_last_access_date_desc':
                $sortColName = 'lastAccessed desc';
                break;
        }

        return $sortColName;
    }

    public function outputSuccess() {
        $html = '';
        $html .= "<script>\n";
        $html .= "$(document).ready(function() {\n";
        $success = notification::getSuccess();
        if (COUNT($success)) {
            $htmlArr = array();
            foreach ($success AS $success) {
                $htmlArr[] = $success;
            }

            $msg = implode("<br/>", $htmlArr);
        }
        $html .= "showSuccessNotification('" . str_replace('\'', '', TranslateHelper::t('success', 'Success')) . "', '" . str_replace('\'', '', $msg) . "');\n";
        $html .= "});\n";
        $html .= "</script>\n";

        return $html;
    }

    public function outputErrors() {
        $html = '';
        $html .= "<script>\n";
        $html .= "$(document).ready(function() {\n";
        $errors = notification::getErrors();
        if (COUNT($errors)) {
            $htmlArr = array();
            foreach ($errors AS $error) {
                $htmlArr[] = $error;
            }

            $msg = implode("<br/>", $htmlArr);
        }
        $html .= "showErrorNotification('" . str_replace('\'', '', TranslateHelper::t('error', 'Error')) . "', '" . str_replace('\'', '', $msg) . "');\n";
        $html .= "});\n";
        $html .= "</script>\n";

        return $html;
    }

    public function getAccountWebRoot() {
        return ACCOUNT_WEB_ROOT;
    }

    public function getAccountCssPath() {
        return SITE_THEME_PATH . '/assets/styles';
    }

    public function getAccountJsPath() {
        return SITE_THEME_PATH . '/assets/js';
    }

    public function getAccountImagePath() {
        return SITE_THEME_PATH . '/assets/images';
    }

}
