<?php
require_once "ConfigWorker.class.php";
require_once "Interfaces/IDBConnector.interface.php";

class MySQLConnector implements IDBConnector {
    private $connection;
    private $statement;

    public function __construct(){
        $configWorker = new ConfigWorker();
        $db_host = $configWorker->getValue("DB_MYSQL_HOST");
        $db_user = $configWorker->getValue("DB_MYSQL_USER");
        $db_password = $configWorker->getValue("DB_MYSQL_PASSWORD");
        $db_workspace = $configWorker->getValue("DB_MYSQL_WORKSPACE");
        try {
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_workspace", $db_user, $db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names utf8");
            $this->statement = $this->connection->prepare("INSERT INTO `monitoring` VALUES (0, :device_id,
                                 :temperature_inside, :temperature_outside, :humidity_inside, :humidity_outside,
                                 :date_time)");
        } catch (PDOException $ex){
            die("Connection error"); //TODO: JSON FORMAT
        }
    }

    public function insert($key_value) {
        try {
            $this->statement->bindParam(':device_id', $key_value["device_id"]);
            $this->statement->bindParam(':temperature_inside', $key_value["temperature_inside"]);
            $this->statement->bindParam(':temperature_outside', $key_value["temperature_outside"]);
            $this->statement->bindParam(':humidity_inside', $key_value["humidity_inside"]);
            $this->statement->bindParam(':humidity_outside', $key_value["humidity_outside"]);
            $this->statement->bindParam(':date_time', $key_value["date_time"]);
            if (!$this->statement->execute()) {
                die("Execute error"); //TODO: JSON FORMAT
            }
            return "insert:OK";
        } catch (PDOException $ex){
            die("Execute exception"); //TODO: JSON FORMAT
        }
    }
}