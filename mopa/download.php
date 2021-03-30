<?php
require_once "Utils/MongoConnector.class.php";

//TODO: future update trough firewall
class Download {
    private $client;

    public function __construct(){
        $this->assignClient();
        $this->process();
    }

//    TODO: reword for mysql + implement mysql
    private function assignClient() {
//        $className = "{$_POST["db_type"]}Connector";
//        $this->client = new $className();
        $this->client = new MongoConnector();
    }

    //TODO: check if exists
    private function process() {
        $this->client->get_interval($_POST['from'], $_POST['to']);
    }
}
new Download();