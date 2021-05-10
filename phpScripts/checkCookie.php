<?php
    include 'generalScripts.php';

    $setUrl = $_POST['setUrl'];
    $unsetUrl = $_POST['unsetUrl'];

    if(isset($_COOKIE['email'])) //if user already logined
    {
        if(isset($setUrl)) gotoURL("../{$setUrl}"); 
    }
    else
    {
        if(isset($unsetUrl)) gotoURL("../{$unsetUrl}"); 
    }
?>