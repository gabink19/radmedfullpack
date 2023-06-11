<?php

namespace Themes\Evolution;

use App\Services\ThemeConfig AS CoreThemeConfig;

class ThemeConfig extends CoreThemeConfig
{
    /**
     * Setup the theme config.
     *
     * @var array
     */
    public $config = array(
        'theme_name' => 'Evolution Theme',
        'folder_name' => 'evolution',
        'theme_description' => 'Bootstrap uCloud theme included with the core script.',
        'author_name' => 'uCloud',
        'author_website' => 'https://mfscripts.com',
        'theme_version' => '1.0',
        'required_script_version' => '5.0',
        'product' => 'cloudable',
        'product_name' => 'uCloud',
        'product_url' => 'https://mfscripts.com/ucloud',
    );

}
