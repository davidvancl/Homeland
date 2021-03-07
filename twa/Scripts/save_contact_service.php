<?php
//    if( empty($_POST) ||
//        $_SERVER['REQUEST_METHOD'] != 'POST' ||
//        !isset($_POST["name"]) ||
//        !isset($_POST["surname"]) ||
//        !isset($_POST["gender"]) ||
//        !isset($_POST["email"]) ||
//        !isset($_POST["phone"]) ||
//        !isset($_POST["message"])
//    ){
//        header("Location: ../Pages/contact.html?code=400");
//        exit();
//    }

    $host = "192.168.2.20";
    $user = "GTAService";
    $password = "Gg123456*";
    $database = "twa";

//    $query = "INSERT INTO `contact_form` VALUES
//                                  (0,'".$_POST["name"]."',
//                                  '".$_POST["surname"]."',
//                                  '".$_POST["email"]."',
//                                  '".$_POST["gender"]."',
//                                  '".$_POST["phone"]."',
//                                  '".$_POST["message"]."')";

//    $connection = new mysqli($host, $user, $password, $database);
    $connection = mysqli_connect($host, $user, $password, $database);

//    if (!$connection->set_charset("utf8mb4")) {
//        header("Location: ../Pages/contact.html?code=300");
//        exit();
//    }

    if($connection === false){
        die("ERROR: Could not connect. " . mysqli_connect_error() . "---".mysqli_connect_errno());
    }

//    if($connection->connect_error) {
//        echo mysqli_connect_error();
//        echo "<br>";
//        echo mysqli_connect_errno();
//        header("Location: ../Pages/contact.html?code=400&sql=".mysqli_connect_errno());
//        exit();
//    }

//    if ($connection->query($query) === TRUE) {
//        header("Location: ../Pages/contact.html?code=200");
//        exit();
//    } else {
//        header("Location: ../Pages/contact.html?code=500");
//        exit();
//    }