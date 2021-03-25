<?php
require_once "ConfigWorker.class.php";

class Firewall {
    private $firewall_permissions = [
        "CHECK_POST" => true,
        "RTC_UPLOAD" => true,
        "FORCE_STOP" => false
    ];

    public function __construct(){
        if ($this->firewall_permissions["CHECK_POST"]) $this->check_permissions();
        if ($this->firewall_permissions["FORCE_STOP"]) die(ConfigWorker::jsonError("606","Force stop by firewall."));
    }

    public function isAllowed($key){
        return $this->firewall_permissions[$key];
    }

    private function check_permissions(){
        if (!isset($_POST) || !isset($_POST["device_id"]) || !isset($_POST["temperature_inside"]) ||
            !isset($_POST["temperature_outside"]) || !isset($_POST["humidity_inside"]) ||
            !isset($_POST["humidity_outside"]) || !isset($_POST["date_time"]) || !isset($_POST["db_type"])){
            die(ConfigWorker::jsonError("608", "Post request corrupted."));
        }
    }
}