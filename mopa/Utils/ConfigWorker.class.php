<?php

class ConfigWorker {
    private static $config_path = __DIR__ . "/../config.cfg";
    private $config = array();

    public function __construct() {
        $this->loadConfig();
    }

    private function loadConfig(){
        $file = fopen(ConfigWorker::$config_path, "r");
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $conf = explode('=', $line);
                $this->config[$conf[0]] = trim(str_replace('"','', $conf[1]));
            }
            fclose($file);
        } else {
            die("Cannot load config.cfg");
        }
    }

    public function getValue($key){
        if (!array_key_exists($key, $this->config)) return false;
        return $this->config[$key];
    }
}