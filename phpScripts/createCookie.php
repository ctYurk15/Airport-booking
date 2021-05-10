<?php

    include 'generalScripts.php';
    
    $email = $_GET['email'];
    $cookieTime = time() + 60*60*24;
    $url = $_GET['page'];
    
    setcookie("email", $email, $cookieTime, "/");
    gotoURL("../".$url);
?>