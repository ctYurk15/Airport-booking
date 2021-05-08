<?php
    $address = "localhost";
    $user = "root";
    $pass = "root";
    $db = "airport";
    
    $conn = new mysqli($address, $user, $pass, $db);
    if($mysqli->connect_error)
    {
        echo "Some error occured with database.";
        exit();
    }
?>