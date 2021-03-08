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

    try {
        $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("set names utf8");

        $statement = $connection->prepare("INSERT INTO `contact_form` VALUES (0, :firstname, :lastname, :email, :gender, :phone, :message)");
        $statement->bindParam(':firstname', $_POST["name"]);
        $statement->bindParam(':lastname', $_POST["surname"]);
        $statement->bindParam(':email', $_POST["email"]);
        $statement->bindParam(':gender', $_POST["gender"]);
        $statement->bindParam(':phone', $_POST["phone"]);
        $statement->bindParam(':message', $_POST["message"]);

        if ($statement->execute()) {
            header("Location: ../Pages/contact.html?code=200");

            exit();
        } else {
            header("Location: ../Pages/contact.html?code=500");
            exit();
        }

    } catch (PDOException $ex) {
        header("Location: ../Pages/contact.html?code=420");
        exit();
    }