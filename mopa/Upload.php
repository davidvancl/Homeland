<?php
require_once "Utils/MongoConnector.class.php";
require_once "Utils/MySQLConnector.class.php";
require_once "Utils/Firewall.class.php";

class Upload extends Firewall {
    private $client;

    function __construct() {
        parent::__construct();
        $this->client = ($_POST["db_type"] === "mongo") ? new MongoConnector() : new MySQLConnector();
        $this->process();
    }

    private function process(){
        $loaded_params = [
            'device_id' => $_POST["device_id"],
            'temperature_inside' => $_POST["temperature_inside"],
            'temperature_outside' => $_POST["temperature_outside"],
            'humidity_inside' => $_POST["humidity_inside"],
            'humidity_outside' => $_POST["humidity_outside"],
            'date_time' => $_POST["date_time"]
        ];
        $this->client->insert($loaded_params);
    }
}
new Upload();