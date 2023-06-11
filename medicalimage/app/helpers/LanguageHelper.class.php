<?php

namespace App\Helpers;

use App\Models\Language;

class LanguageHelper
{
    static function getActiveLanguages() {
        return Language::loadByClause('isActive = 1', array(), 'languageName ASC');
    }
}
