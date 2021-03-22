<?php
    require_once __DIR__ . '/vendor/autoload.php';

    try {
        $client = new MongoDB\Client("mongodb://mopaAdmin:Mm123456*@192.168.2.20:27017");
        $db = $client->selectDatabase("mopa");
        $collection = $db->selectCollection("monitoring");
//        $collection->insertOne([
//            'username' => 'user',
//            'email' => 'user@example.com',
//            'name' => 'user User',
//        ]);
        echo "OK";
    } catch (Exception $e) {
        echo $e->getCode().  "<br>";
        echo $e->getMessage();
    }