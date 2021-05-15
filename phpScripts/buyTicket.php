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
            $reisID = $_POST['reisID'];
            $place = $dbGeneral->getColumn('ReservedCount', 'reis', 'id', $reisID);
            
            $user->purchaseTicket($reisID, $place);
            echo "Квиток на рейс PS10{$reisID} успішно куплено";
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