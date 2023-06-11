<?php

namespace App\Controllers\admin;

use App\Controllers\admin\AdminBaseController;
use App\Core\Database;
use App\Helpers\AdminApiHelper;

class AdminApiController extends AdminBaseController
{

    public function api() {
        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        
        // required variables
        $key = '';
        if ($request->request->has('key')) {
            $key = $request->request->get('key');
        }

        if (strlen($key) == 0) {
            AdminApiHelper::outputError('Error: API access key not found.');
        }

        $username = '';
        if ($_REQUEST['username']) {
            $username = $_REQUEST['username'];
        }

        if (strlen($username) == 0) {
            AdminApiHelper::outputError('Error: Username not found.');
        }

        $action = '';
        if ($_REQUEST['action']) {
            $action = $_REQUEST['action'];
        }

        if (strlen($action) == 0) {
            AdminApiHelper::outputError('Error: Action not found.');
        }

        // make sure user has access
        $rs = AdminApiHelper::validateAccess($key, $username);
        if (!$rs) {
            AdminApiHelper::outputError('Error: Could not validate api access details.');
        }

        // check action exists
        $actualMethod = 'api' . UCFirst($action);
        if (!method_exists(AdminApiHelper, $actualMethod)) {
            AdminApiHelper::outputError('Error: Action of \'' . $action . '\' not found. Method: ' . $actualMethod . '()');
        }

        // call action
        echo call_user_func(array($api, $actualMethod), $_REQUEST);
        exit;
    }

}
