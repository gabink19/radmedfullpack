<?php

namespace Themes\Evolution\Controllers;

use App\Controllers\FileController AS CoreFileController;
use App\Models\File;
use App\Helpers\ThemeHelper;

class FileController extends CoreFileController
{    
    /**
     * File password page not needed in this theme.
     * 
     * @return type
     */
    public function filePassword() {
        // pickup request for later
        $request = $this->getRequest();
        
        // in this theme the permissions is handled by the folder
        $file = File::loadOneByShortUrl($request->query->get('file'));
        if(!$file)
        {
            // on failure
            return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        // redirect to folder, which then prompts for the password
        $folder = $file->getFolderData();
        if(!$folder)
        {
            // on failure
            return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }
        
        return $this->redirect($folder->getFolderUrl());
    }

    /**
     * Dedicated file info page not needed in this theme.
     * 
     * @return type
     */
    public function fileInfo($shortUrl) {
        // pickup request for later
        $request = $this->getRequest();
        
        // load file
        $file = File::loadOneByShortUrl($shortUrl);
        if(!$file)
        {
            // on failure
            return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        return $this->redirect($file->getFullShortUrl());
    }
}
