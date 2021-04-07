<?php
require_once "Utils/MongoConnector.class.php";
require_once "Utils/MySQLConnector.class.php";
require_once "Utils/Firewall.class.php";
require_once "Utils/ClientRTC.class.php";

class Upload extends Firewall {
    private $client;

    function __construct() {
        parent::__construct([
            "device_id",
            "temperature_inside",
            "temperature_outside",
            "humidity_inside",
            "humidity_outside",
            "date_time",
            "db_type",
            "co2_inside",
            "co2_outside"
        ], true);
        $this->assignClient();
        $this->process();
    }

    private function assignClient(){
        $className = "{$_POST["db_type"]}Connector";
        $this->client = new $className();
    }

    private function process(){
        $loaded_params = [
            'device_id' => $_POST["device_id"],
            'temperature_inside' => $_POST["temperature_inside"],
            'temperature_outside' => $_POST["temperature_outside"],
            'humidity_inside' => $_POST["humidity_inside"],
            'humidity_outside' => $_POST["humidity_outside"],
            'co2_inside' => $_POST["co2_inside"],
            'co2_outside' => $_POST["co2_outside"],
            'date_time' => $_POST["date_time"]
        ];

        if ($this->client->insert($loaded_params) === "insert:OK"){
            if($this->isAllowed("RTC_UPLOAD")) ClientRTC::sendData($loaded_params);
            echo "{OK}";
        }
    }
}
new Upload();