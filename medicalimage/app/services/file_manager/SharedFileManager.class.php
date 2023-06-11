<?php

namespace App\Services\File_Manager;

use App\Core\Database;
use App\Models\FileFolder;
use App\Helpers\AuthHelper;
use App\Helpers\ThemeHelper;
use App\Helpers\TranslateHelper;

class SharedFileManager extends BaseFileManager
{

    public function getData() {
        // preload current user and DB
        $Auth = AuthHelper::getAuth();

        // prepare variables
        $foldersClauseReplacements = array();
        $filesClauseReplacements = array();
        
        // root level
        if ((int)$this->getParameter('nodeId') === 0) {
            // prepare the SQL clause for root level
            $foldersClause = 'WHERE file_folder.status = "active" '
                    . 'AND file_folder.id IN ('
                    . 'SELECT folder_id '
                    . 'FROM file_folder_share '
                    . 'LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id '
                    . 'LEFT JOIN file_folder ON file_folder_share_item.folder_id = file_folder.id '
                    . 'WHERE (shared_with_user_id = :user_id OR (shared_with_user_id IS NULL AND is_global = 1)) '
                    . 'AND folder_id IS NOT NULL '
                    . 'AND (file_folder.parentId IS NULL OR file_folder.parentId NOT IN ('
                    . 'SELECT folder_id FROM file_folder_share LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id WHERE (shared_with_user_id = :user_id OR (shared_with_user_id IS NULL AND is_global = 1)) AND folder_id IS NOT NULL '
                    . '))'
                    . ')';
            $foldersClauseReplacements['user_id'] = $Auth->id;
            
            // files SQL
            $filesClause = 'WHERE file.status = "active" '
                    . 'AND file.id IN ('
                    . 'SELECT file_id '
                    . 'FROM file_folder_share '
                    . 'LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id '
                    . 'WHERE (shared_with_user_id = :user_id OR (shared_with_user_id IS NULL AND is_global = 1)) '
                    . 'AND file_id IS NOT NULL '
                    . ')';
            $filesClauseReplacements['user_id'] = $Auth->id;
        }
        // folder level
        else {
            if ($this->currentFolder === null) {
                $this->currentFolder = FileFolder::loadOneById($this->getParameter('nodeId'));
            }
            if (!$this->currentFolder) {
                $this->throwException('Failed loading folder.');
            }
            
            // prepare the SQL clause for folder level
            $foldersClause = 'WHERE file_folder.status = "active" '
                . 'AND file_folder.id IN ('
                . 'SELECT folder_id '
                . 'FROM file_folder_share '
                . 'LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id '
                . 'LEFT JOIN file_folder ON file_folder_share_item.folder_id = file_folder.id '
                . 'WHERE (shared_with_user_id = :user_id OR (shared_with_user_id IS NULL AND is_global = 1)) '
                . 'AND file_folder.parentId = :parent_id '
                . ')';
            $foldersClauseReplacements['user_id'] = $Auth->id;
            $foldersClauseReplacements['parent_id'] = $this->getParameter('nodeId');
            
            // files SQL - assuming any files which exist in shared folders can
            // be accessed
            $filesClause = 'WHERE file.status = "active" '
                    . 'AND file.folderId = :folder_id '
                    . 'AND file.folderId IN ('
                    . 'SELECT folder_id '
                    . 'FROM file_folder_share '
                    . 'LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id '
                    . 'LEFT JOIN file_folder ON file_folder_share_item.folder_id = file_folder.id '
                    . 'WHERE (shared_with_user_id = :user_id OR (shared_with_user_id IS NULL AND is_global = 1)) '
                    . 'AND file_folder.id = :folder_id '
                    . ')';
            $filesClauseReplacements['user_id'] = $Auth->id;
            $filesClauseReplacements['folder_id'] = $this->getParameter('nodeId');
        }

        // load the folders data into the object
        $this->getFoldersData($foldersClause, $foldersClauseReplacements);
        
        // make sure we've set the session variables to allow access
        if(count($this->folders)) {
            foreach($this->folders AS $folder) {
                $_SESSION['sharekeyFolder' . $folder['id']] = true;
            }
        }

        // load the files data into the object
        $this->getFilesData($filesClause, $filesClauseReplacements);
        
        // make sure we've set the session variables to allow access
        if(count($this->files)) {
            foreach($this->files AS $file) {
                $_SESSION['sharekeyFile' . $file['id']] = true;
            }
        }
    }

    public function requiresLogin() {
        // allow logged in only users
        return true;
    }

    public function getRequiredPrechecks() {
        return false;
    }

    public function getPageTitle() {
        return TranslateHelper::t('shared_with_me', 'Shared With Me');
    }

    public function getPageUrl() {
        return ThemeHelper::getLoadedInstance()->getAccountWebRoot() . '/shared_with_me';
    }
    
    public function getNoResultsHtml() {
        $msg = TranslateHelper::t('no_shared_files_found', 'No files or folders have been shared with your account.');
        if ((int)$this->getParameter('nodeId') > 0) {
            $msg = TranslateHelper::t('no_files_found_in_folder', 'No files found within this folder.');
        }
        
        return '<div class="alert alert-warning"><i class="entypo-attention"></i> '
                . $msg
                . '</div>';
    }

    public function getBreadcrumbs() {
        // get base level first
        $breadcrumbs = $this->getBaseBreadcrumbs();

        // add on any custom breadcrumbs
        $breadcrumbs[] = '<a href="#" onClick="loadImages(\'' . $this->getPageType() . '\', \'\', 1); return false;" class="btn btn-white">' . $this->getPageTitle() . $this->getBreadcrumbTotalText() . '</a>';

        return $breadcrumbs;
    }

    public function getShareAccessLevel() {
        // get database
        $db = Database::getDatabase();
        
        // load the access level based on folder id
        if($this->currentFolder !== null) {
            // prepare the SQL clause for folder level
            $accessLevel = $db->getValue('SELECT share_permission_level '
                . 'FROM file_folder_share '
                . 'LEFT JOIN file_folder_share_item ON file_folder_share.id = file_folder_share_item.file_folder_share_id '
                . 'WHERE (shared_with_user_id = :user_id OR (shared_with_user_id IS NULL AND is_global = 1)) '
                    . 'AND file_folder_share_item.folder_id = :folder_id', array(
                        'user_id' => $Auth->id,
                        'folder_id' => $this->currentFolder->id,
                    ));
            if($accessLevel) {
                return $accessLevel;
            }
        }
        
        return 'view';
    }
}
