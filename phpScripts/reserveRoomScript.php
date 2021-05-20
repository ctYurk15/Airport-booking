<?php

    if(isset($_COOKIE['email'])) //if user already logined
    {
        include 'dbconnect.php';
        include 'generalScripts.php';
        include 'User.php';
        include 'DBgeneral.php';

        $user = new User($conn, $_COOKIE['email']);
        $dbGeneral = new DBgeneral($conn);
        
        if(!$user->isColumnNull('PassId')) //checking if passport set
        {
            $roomID = $_POST['idRoom'];
            
            $user->orderRoom($roomID);
            echo "Номер у готелі успішно заброньовано";
        }
        else
        {
            echo "Будь ласка, верифікуйте свій аккаунт";
        }
    }
    else
    {
        gotoURL("../index.html"); 
    }

?>