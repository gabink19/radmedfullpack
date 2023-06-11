<?php

namespace App\Core;

date_default_timezone_set("Asia/Jakarta");

use App\Helpers\AuthHelper;
use App\Helpers\CoreHelper;
use App\Helpers\TemplateHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;

// Base Controller
class BaseController
{
    public function __construct() {
        // does nothing yet, can be implemented by the extending class
    }
    
    public function getAuth() {
        return AuthHelper::getAuth();
    }

    public function render($template, $params = array(), $templatePath = null) {
        return new Response(
                $this->getRenderedTemplate($template, $params, $templatePath)
        );
    }
    
    public function getRenderedTemplate($template, $params = array(), $templatePath = null) {
        return TemplateHelper::render($template, $params, $templatePath);
    }

    public function renderJson($arr) {
        $response = $this->renderContent(json_encode($arr));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    public function renderContent($str) {
        $response = new Response();
        $response->setContent($str);

        return $response;
    }
    
    public function redirect($url) {
        return new RedirectResponse($url);
    }
    
    public function renderFileContent($fileContent, $headers = array()) {
        return new Response($fileContent, 200, $headers);
    }
    
    public function renderDownloadFile($fileContent, $filename = 'file.csv') {
        $headers = array(
            'Cache-Control' => 'private',
            'Content-length' => strlen($fileContent),
            'Content-Disposition' => 'attachment; filename="' . $filename . '";'
        );
        
        return $this->renderFileContent($fileContent, $headers);
    }
    
    public function renderDownloadFileFromPath($filePath, $filename = 'file.csv') {
        // clear any buffering to stop possible memory issues with readfile()
        @ob_end_clean();
        
        // this should return the file to the browser as response
        $response = new BinaryFileResponse($filePath);
        
        // prepare needs to be called otherwise downloads have zero content
        $response->prepare(Request::createFromGlobals());

        // set content disposition inline of the file
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );
        
        return $response;
    }
    
    public function renderEmpty200Response() {
        return $this->renderContent('');
    }
    
    public function render404() {
        $response = $this->render('error/404.html');
        $response->setStatusCode(404);
        
        return $response;
    }

    public function getRequest() {
        return Request::createFromGlobals();
    }
    
    public function requireLogin() {
        // make sure the user is logged in
        $Auth = $this->getAuth();
        if (!$Auth->loggedIn()) {
            return $this->redirect(CoreHelper::getCoreSitePath() . '/account/login');
        }
        
        return false;
    }
    
    public function getCurrentRoute() {
        $uri = $_SERVER['REQUEST_URI'];
        if(strlen($uri) === 0) {
            return false;
        }
        
        // get the full path to the install, minus the host
        $basePath = str_replace(_CONFIG_SITE_HOST_URL, '', _CONFIG_SITE_FULL_URL);
        
        // if $basePath is greater than 1 character in length, replace the path
        if(strlen($basePath) > 0) {
            $uri = str_replace($basePath, '', $uri);
        }

        return $uri;
    }

}
