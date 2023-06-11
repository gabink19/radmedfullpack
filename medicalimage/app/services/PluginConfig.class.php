<?php

namespace App\Services;

class PluginConfig
{
    /**
     * The plugin config, should be overridden by the child class
     *
     * @var array
     */
    public $config = array();

    public function getPluginConfig() {
        return $this->config;
    }
    
    public function getFolderName() {
        return $this->config['folder_name'];
    }

    public function getPluginVersion() {
        return $this->config['plugin_version'];
    }
}
