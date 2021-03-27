<?php
require_once "ConfigWorker.class.php";

class Firewall {
    private $MONGO_DB = "Mongo";
    private $MYSQL_DB = "MySQL";

    private $authorized_rsa_keys = [
        "DESKTOP-5PV5MB5" => "",
    ];

    private $firewall_permissions = [
        "CHECK_POST" => true,
        "RTC_UPLOAD" => true,
        "VALIDATE_DB" => true,
        "SSH_VERIFY" => true,
        "FORCE_STOP" => false
    ];

    public function __construct(){
        if ($this->firewall_permissions["CHECK_POST"]) $this->check_params();
        if ($this->firewall_permissions["VALIDATE_DB"]) $this->validateDB();
        if ($this->firewall_permissions["SSH_VERIFY"]) $this->verify_ssh_key();
        if ($this->firewall_permissions["FORCE_STOP"]) die(ConfigWorker::jsonError("606","Force stop by firewall."));
    }

    public function isAllowed($key){
        return $this->firewall_permissions[$key];
    }

    private function check_params(){
        if (!isset($_POST) || !isset($_POST["device_id"]) || !isset($_POST["temperature_inside"]) ||
            !isset($_POST["temperature_outside"]) || !isset($_POST["humidity_inside"]) ||
            !isset($_POST["humidity_outside"]) || !isset($_POST["date_time"]) || !isset($_POST["db_type"]) ||
            !isset($_POST["co2_inside"]) || !isset($_POST["co2_outside"])){
            die(ConfigWorker::jsonError("608", "Post request corrupted."));
        }
    }

    private function validateDB(){
        if ($_POST["db_type"] !== $this->MONGO_DB && $_POST["db_type"] !== $this->MYSQL_DB)
            die(ConfigWorker::jsonError("805", "Incorrect DB selection."));
    }

    private function verify_ssh_key(){
        if (!isset($_POST["rsa_key"]))
            die(ConfigWorker::jsonError("702", "rsa_key required"));
        if (!array_key_exists($_POST["device_id"], $this->authorized_rsa_keys) ||
            $this->authorized_rsa_keys[$_POST["device_id"]] != $_POST["rsa_key"])
            die(ConfigWorker::jsonError("705", "Verification failed. No permissions."));
    }
}