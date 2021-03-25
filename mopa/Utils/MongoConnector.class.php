<?php
require_once "Interfaces/IDBConnector.interface.php";
require_once "ConfigWorker.class.php";
require_once __DIR__ . '/../vendor/autoload.php';

class MongoConnector implements IDBConnector {
    private $client;
    private $database;
    private $collection;

    public function __construct(){
        try {
            $db_user = ConfigWorker::getValue("DB_MONGO_USER");
            $db_passwd = ConfigWorker::getValue("DB_MONGO_PASSWORD");
            $db_host = ConfigWorker::getValue("DB_MONGO_HOST");
            $db_port = ConfigWorker::getValue("DB_MONGO_PORT");
            $this->client = new MongoDB\Client("mongodb://{$db_user}:{$db_passwd}@{$db_host}:{$db_port}");
            $this->database = $this->client->selectDatabase(ConfigWorker::getValue("DB_MONGO_WORKSPACE"));
            $this->collection = $this->database->selectCollection(ConfigWorker::getValue("DB_MONGO_COLLECTION"));
        } catch (Exception $error) {
            die(ConfigWorker::jsonError($error->getCode(),$error->getMessage()));
        }
    }

    public function insert($key_value) {
        $this->collection->insertOne($key_value);
        return "insert:OK";
    }
}