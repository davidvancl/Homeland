<?php
//CREATE TABLE `contact_form` (id int AUTO_INCREMENT, name VARCHAR(50), surname VARCHAR(50), email VARCHAR(100), gender VARCHAR(10), telephone VARCHAR(15), message VARCHAR(500), PRIMARY KEY (id));

    if( empty($_POST) ||
        $_SERVER['REQUEST_METHOD'] != 'POST' ||
        !isset($_POST["name"]) ||
        !isset($_POST["surname"]) ||
        !isset($_POST["gender"]) ||
        !isset($_POST["email"]) ||
        !isset($_POST["phone"]) ||
        !isset($_POST["message"])
    ){
        header("Location: ../Pages/contact.html?code=400");
        exit();
    }

    $host = "192.168.2.20";
    $user = "GTAService";
    $password = "GTAService123456*";
    $database = "twa";

    $connection = new mysqli($host, $user, $password,$database);
    if ($connection->connect_error) {
        header("Location: ../Pages/contact.html?code=420");
        exit();
    }

    $query = "INSERT INTO `contact_form` VALUES
                                  (0,'".$_POST["name"]."',
                                  '".$_POST["surname"]."',
                                  '".$_POST["email"]."',
                                  '".$_POST["gender"]."',
                                  '".$_POST["phone"]."',
                                  '".$_POST["message"]."')";

    if ($connection->query($query) === TRUE) {
        header("Location: ../Pages/contact.html?code=200");
        exit();
    } else {
        header("Location: ../Pages/contact.html?code=500");
        exit();
    }