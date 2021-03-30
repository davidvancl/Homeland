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

    public function get_interval($time_from, $time_to) {
        $cursor = $this->collection->find([
            "date_time" => [
                '$gte' => $time_from,
                '$lt' => $time_to
            ]
        ]);
        $jsonObject = [ 'data' => [] ];
        foreach ($cursor as $object) {
            $jsonObject['data'][] = [
                'date' => $object['date_time'],
                'temperatureInside' => $object['temperature_inside'],
                'temperatureOutside' => $object['temperature_outside'],
                'humidityInside' => $object['humidity_inside'],
                'humidityOutside' => $object['humidity_outside'],
                'co2Inside' => $object['co2_inside'],
                'co2Outside' => $object['co2_outside']
            ];
        }
        echo json_encode($jsonObject);
    }
}