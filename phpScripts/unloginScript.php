<?php

    include 'generalScripts.php';

    $url = $_GET['page'];
    setcookie('email', '', time() - 10, "/");
    gotoURL("../".$url);
    
    
?>