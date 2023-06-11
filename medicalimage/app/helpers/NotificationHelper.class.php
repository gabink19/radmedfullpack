<?php

namespace App\Helpers;

class NotificationHelper
{
    private static $pageErrorArr = array();
    private static $pageSuccessArr = array();

    static function isErrors() {
        if (COUNT(self::$pageErrorArr)) {
            return true;
        }

        return false;
    }

    static function setError($errorMsg) {
        self::$pageErrorArr[] = $errorMsg;
    }

    static function getErrors() {
        return self::$pageErrorArr;
    }

    static function isSuccess() {
        if (COUNT(self::$pageSuccessArr)) {
            return true;
        }

        return false;
    }

    static function setSuccess($sucessMsg) {
        self::$pageSuccessArr[] = $sucessMsg;
    }

    static function getSuccess() {
        return self::$pageSuccessArr;
    }

}
