<?php

class Firewall {
    private $firewall_permissions = [
        "CHECK_POST" => true
    ];

    public function __construct(){
        if ($this->firewall_permissions["CHECK_POST"]) $this->check_permissions();
    }

    private function check_permissions(){
        if (!isset($_POST) || !isset($_POST["device_id"]) || !isset($_POST["temperature_inside"]) ||
            !isset($_POST["temperature_outside"]) || !isset($_POST["humidity_inside"]) ||
            !isset($_POST["humidity_outside"]) || !isset($_POST["date_time"]) || !isset($_POST["db_type"])){
            die("Post request error"); // TODO JSON FORMAT
        }
    }
}