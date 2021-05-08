<?php
    
    include 'dbconnect.php';
    include 'User.php';

    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);

    if(User::correctLogin($email, $pass, $conn))
    {
        echo "Успішний логін";
    }
    else
    {
        echo "Ваша пошта або пароль неправильні";
    }

?>