<?php

    include 'dbconnect.php';
    include 'generalScripts.php';
    include 'DBgeneral.php';

    $dbgeneral = new DBgeneral($conn);

    $action = $_POST["action"];

    //what info user wants to get
    if($action == 'get_cities')
    {
        $result = $dbgeneral->getAllCities();
        echo json_encode($result);
    }

?>