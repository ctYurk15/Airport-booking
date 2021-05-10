<?php
    
    include 'dbconnect.php';
    include 'generalScripts.php';
    include 'User.php';

    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);

    if(User::correctLogin($email, $pass, $conn))
    {
        gotoURL("phpScripts/createCookie.php?email={$email}&page=Flights.html");
    }
    else
    {
        echo "Ваша пошта або пароль неправильні";
    }

?>