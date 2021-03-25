<?php

abstract class ConfigWorker {
   private static $configuration = [
       //MONGO Config
       "DB_MONGO_USER" => "mopaAdmin",
       "DB_MONGO_PASSWORD" => "Mm123456*",
       "DB_MONGO_HOST"=>"192.168.2.20",
       "DB_MONGO_PORT" => "27017",
       "DB_MONGO_WORKSPACE" => "mopa",
       "DB_MONGO_COLLECTION" => "monitoring",
       //MYSQL Config
       "DB_MYSQL_HOST" => "192.168.2.20",
       "DB_MYSQL_USER" => "mopaAdmin",
       "DB_MYSQL_PASSWORD" => "Mm123456*",
       "DB_MYSQL_WORKSPACE" => "mopa",
       //RTC Config
       "RTC_PORT" => "9999",
       "RTC_HOST" => "192.168.2.20"
   ];

    public static function getValue($key){
        if (!array_key_exists($key, ConfigWorker::$configuration)) return false;
        return ConfigWorker::$configuration[$key];
    }

    public static function jsonError($errno, $error){
        return json_encode([
            'error_code' => $errno,
            'error_msg' => $error
        ]);
    }
}