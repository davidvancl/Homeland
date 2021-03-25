<?php
require_once "ConfigWorker.class.php";

abstract class ClientRTC {
    public static function sendData($data){
        $socket = socket_create(AF_INET,SOCK_STREAM, SOL_TCP);
        $result = socket_connect($socket, ConfigWorker::getValue("RTC_HOST"), ConfigWorker::getValue("RTC_PORT"));
        if(!$result){
            die(ConfigWorker::jsonError("NaN", socket_strerror(socket_last_error()).PHP_EOL));
        }
        socket_write($socket, json_encode($data));
    }
}