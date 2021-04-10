<?php
require_once "Utils/Firewall.class.php";
require_once "Utils/MongoConnector.class.php";
require_once "Utils/MySQLConnector.class.php";

class Download extends Firewall {
    private $client;

    public function __construct(){
        parent::__construct(["db_type", "from", "to"], false);
        $this->assignClient();

        if (isset($_POST['export']) && !empty($_POST['export'])){
            $this->export();
        } else {
            $this->process();
        }
    }

    private function assignClient() {
        $className = "{$_POST["db_type"]}Connector";
        $this->client = new $className();
    }

    private function process() {
        echo($this->client->get_interval($_POST['from'], $_POST['to']));
    }

    private function export(){
        $json = $this->client->get_interval($_POST['from'], $_POST['to']);
    }
}
new Download();