<?php

namespace Themes\Evolution\Controllers;

use App\Controllers\IndexController AS CoreIndexController;
use App\Helpers\CoreHelper;

class IndexController extends CoreIndexController
{
    public function index() {
        return $this->redirect(CoreHelper::getCoreSitePath() . "/account");
    }
}
