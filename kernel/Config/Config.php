<?php

namespace App\kernel\Config;

include_once (APP_PATH . "/kernel/Config/ConfigInterface.php");

use App\kernel\Config\ConfigInterface;

class Config implements ConfigInterface
{
    public function get(string $key, $default = null) : mixed {
        [$file, $key] = explode(".", $key);

        $config_path = APP_PATH . "/config/$file.php";

        if (!file_exists($config_path)) {
            return $default;
        }

        $config = require $config_path;
        
        return $config[$key] ?? $default;
    }
}