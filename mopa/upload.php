<?php
require_once "Utils/MongoConnector.class.php";
require_once "Utils/MySQLConnector.class.php";
require_once "Utils/Firewall.class.php";

class Upload extends Firewall {
    private $MONGO_DB = "Mongo";
    private $MYSQL_DB = "MySQL";
    private $client;

    function __construct() {
        parent::__construct();
        $this->validateDB();
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
            'date_time' => $_POST["date_time"]
        ];

        if ($this->client->insert($loaded_params) === "insert:OK"){

            $host = "192.168.2.20"; //TODO: CLASS
            $port = 9999;

            $socket = socket_create(AF_INET,SOCK_STREAM, SOL_TCP);
            $result = socket_connect($socket, $host, $port);

            if(!$result){
                die("cannot connect" . socket_strerror(socket_last_error()).PHP_EOL);
            }
            socket_write($socket, "HELLO WORLD INSERT SCRIPT");
        }
        echo "OK";
    }

    private function validateDB(){
        if ($_POST["db_type"] !== $this->MONGO_DB && $_POST["db_type"] !== $this->MYSQL_DB) die("DB Validator ERROR");
    }
}
new Upload();