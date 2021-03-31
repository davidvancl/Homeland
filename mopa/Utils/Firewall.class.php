<?php
require_once "ConfigWorker.class.php";

class Firewall {
    private $MONGO_DB = "Mongo";
    private $MYSQL_DB = "MySQL";

    private $authorized_rsa_keys = [
        "DESKTOP-5PV5MB5" => "AAAAB3NzaC1yc2EAAAADAQABAAAAgQCpu3i+T8LGzHY89n9zbT8wtIO+KzDiHVu9K0XkbLJxisw85XdJPSw4QGwujxtY5qPjtntlgy2Z4hEfPD0aczlEHfv8ejTBdox9I8+515R6Q+/0CXsQjs2hWV8cUxd8/Z8PnKdYbWOHCT78ggYrIRuGzZGrAa8kGPxoQSIHMROTnQ==",
    ];

    private $firewall_permissions = [];

    public function __construct($required_params, $isUpload){
        $this->assign_permissions($isUpload);
        if ($this->firewall_permissions["CHECK_PARAMS"]) $this->check_params($required_params);
        if ($this->firewall_permissions["CHECK_PARAMS_NOT_EMPTY"]) $this->check_params_not_empty($required_params);
        if ($this->firewall_permissions["VALIDATE_DB"]) $this->validateDB();
        if ($this->firewall_permissions["SSH_VERIFY"]) $this->verify_ssh_key();
        if ($this->firewall_permissions["FORCE_STOP"]) die(ConfigWorker::jsonError("606","Force stop by firewall."));
    }

    public function isAllowed($key){
        return $this->firewall_permissions[$key];
    }

    private function assign_permissions($isUpload){
        $this->firewall_permissions = [
            "CHECK_PARAMS" => true,
            "CHECK_PARAMS_NOT_EMPTY" => true,
            "RTC_UPLOAD" => $isUpload,
            "VALIDATE_DB" => true,
            "SSH_VERIFY" => $isUpload,
            "FORCE_STOP" => false
        ];
    }

    private function check_params($required_params){
        if (!isset($_POST)) die(ConfigWorker::jsonError("608", "Post request corrupted."));
        foreach ($required_params as $parameter){
            if (!isset($_POST[$parameter])) die(ConfigWorker::jsonError("608", "Post request corrupted."));
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

    private function check_params_not_empty($required_params){
        foreach ($required_params as $parameter){
            if (empty($_POST[$parameter])) die(ConfigWorker::jsonError("609", "One or more params are empty. Blocking by firewall."));
        }
    }
}