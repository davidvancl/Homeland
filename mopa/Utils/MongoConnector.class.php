<?php
require_once "Interfaces/IDBConnector.interface.php";
require_once "ConfigWorker.class.php";
require_once __DIR__ . '/../vendor/autoload.php';

class MongoConnector implements IDBConnector {
    private $client;
    private $database;
    private $collection;

    public function __construct(){
        $configWorker = new ConfigWorker();
        $db_user = $configWorker->getValue("DB_MONGO_USER");
        $db_passwd = $configWorker->getValue("DB_MONGO_PASSWORD");
        $db_host = $configWorker->getValue("DB_MONGO_HOST");
        $db_port = $configWorker->getValue("DB_MONGO_PORT");
        try {
            $this->client = new MongoDB\Client("mongodb://{$db_user}:{$db_passwd}@{$db_host}:{$db_port}");
            $this->database = $this->client->selectDatabase($configWorker->getValue("DB_MONGO_WORKSPACE"));
            $this->collection = $this->database->selectCollection($configWorker->getValue("DB_MONGO_COLLECTION"));
        } catch (Exception $e) {
            echo $e->getCode(); //TODO: JSON FORMAT
            die();
        }
    }

    public function insert($key_value) {
        $this->collection->insertOne($key_value);
        return "insert:OK";
    }
}