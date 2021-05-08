<?php
    
    include 'dbconnect.php';
    include 'User.php';
    
    //getting registration values
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);

    $error = false;

    //if fields is empty
    if(empty($firstname) || empty($lastname) || empty($email) || empty($pass))
    {
        echo "Заповніть будь ласка усі поля";
        $error = true;
    }

    //if email is not valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "Пошта не є валідною!";
        $error = true;
    }

    //if email is already used
    if(User::strValueExists("email", $email, $conn))
    {
        echo "Ця пошта уже зайнята";
        $error = true;
    }

    if(!$error)
    {
        if(User::addNewUser($firstname, $lastname, $email, $pass, $conn)) //if registration was correct
        {
            echo "Registration successful.";
        }
    }
?>