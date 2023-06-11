<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\FileFolder;
use App\Helpers\CoreHelper;

class AccountDownloadController extends AccountController
{
    public function directDownload($fileId) {
        // get params for later
        $Auth = $this->getAuth();

        // load the file and make sure user owns it
        $file = File::loadOneById($fileId);
        if(!$file) {
            return $this->render404();
        }
        
        // check permissions
        $folder = FileFolder::loadOneById($file->folderId);
        if (((int) $folder->userId > 0) && ($folder->userId != $Auth->id)) {
            if (CoreHelper::getOverallPublicStatus($folder->userId, $folder->id, $file->id) == false) {
                return $this->render404();
            }
        }
        
        // if we've got this far, the user can access the file
        return $this->redirect($file->generateDirectDownloadUrl());
    }
}
