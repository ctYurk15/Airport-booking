<?php

    include 'DBgeneral.php';
    include 'dbconnect.php';

    $dbgeneral = new DBgeneral($conn);

    //what user wants to get
    $action = $_POST['action'];

    $result = null;

    //what we need to return
    if($action == 'hotels_info')
    {
        $result = $dbgeneral->getAllHotels();
    }
    else if($action == 'roomtypes_info')
    {
        $result = $dbgeneral->getRoomTypes();
    }

    echo json_encode($result);

?>