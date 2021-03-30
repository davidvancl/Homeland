<?php

interface IDBConnector {
    public function insert($key_value);
    public function get_interval($time_from, $time_to);
}