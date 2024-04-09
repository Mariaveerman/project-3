<?php
    $serverneme = "localhost";
    $username = "root";
    $password = "Wachtwoord";
    $db_name = "kruidenier";
    $conn = new mysqli($serverneme, $username, $password, $db_name);
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
?>