<?php
require_once "DBExtension.class.php";
require_once "ConfigWorker.class.php";
require_once "Interfaces/IDBConnector.interface.php";

class MySQLConnector extends DBExtension implements IDBConnector {
    private $connection;
    private $statement;

    public function __construct(){
        try {
            $db_host = ConfigWorker::getValue("DB_MYSQL_HOST");
            $db_user = ConfigWorker::getValue("DB_MYSQL_USER");
            $db_password = ConfigWorker::getValue("DB_MYSQL_PASSWORD");
            $db_workspace = ConfigWorker::getValue("DB_MYSQL_WORKSPACE");

            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_workspace", $db_user, $db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names utf8");
            $this->statement = $this->connection->prepare("INSERT INTO `monitoring` VALUES (0, :device_id,
                                 :temperature_inside, :temperature_outside, :humidity_inside, :humidity_outside, 
                                 :co2_inside, :co2_outside, :date_time)");
        } catch (PDOException $exception){
            die(ConfigWorker::jsonError($exception->getCode(),$exception->getMessage()));
        }
    }

    public function insert($key_value): string {
        try {
            foreach ($key_value as $key => $value){
                $this->statement->bindParam((":".$key), $key_value[$key]);
            }
            if (!$this->statement->execute()) die(ConfigWorker::jsonError("700","MySQL execute error."));
            return "insert:OK";
        } catch (PDOException $ex){
            die(ConfigWorker::jsonError($ex->getCode(),$ex->getMessage()));
        }
    }

    public function get_interval($time_from, $time_to) {
        try {
            $get_statement = $this->connection->prepare("SELECT * FROM monitoring WHERE date_time >= :date_from AND date_time <= :date_to");
            $get_statement->bindParam(":date_from", $time_from);
            $get_statement->bindParam(":date_to", $time_to);
            if (!$get_statement->execute()) die(ConfigWorker::jsonError("700","MySQL execute error."));

            return $this->get_db_json_response($get_statement->fetchAll());
        } catch (PDOException $exception){
            die(ConfigWorker::jsonError($exception->getCode(), $exception->getMessage()));
        }
    }
}