<?php

    include 'dbconnect.php';
    include 'User.php';
    include 'DBgeneral.php';
    include 'generalScripts.php';
    
    //what user wants to do
    $action = $_POST['action'];
    $dbgeneral = new DBgeneral($conn);

    //user we`re working with
    $user = new User($conn, $_COOKIE['email']);
    $userID = $user->getColumn('id');

    //returning data like tickets and rooms
    if($action == "get_tickets")
    {
        echo json_encode(array('tickets' => $user->getTicketsPurchased() ));
    }
    else if($action == "hotel_rooms")
    {
        echo json_encode(array('rooms' => $user->getRoomsReserved() ));
    }
    //returning data like is loggined, is passport set, etc
    else if($action == "is_loggined")
    {
        echo json_encode(array('is_loggined' => isset($_COOKIE['email'])));
    }
    else if($action == "passport_status")
    {
        $Confirmed = $dbgeneral->getColumn('Confirmed', 'passport_request', 'User_Id', $userID);
        $passId = null;

        if($Confirmed) //if account is verified, we can get passport id
        {
            $passId = $dbgeneral->getColumn('PassId', '`user`', 'id', $userID);
        }
        
        //sending result
        echo json_encode(array(
            'confirmed' => $Confirmed,
            'passId' => $passId
        ));
    }
    

?>