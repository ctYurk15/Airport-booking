<?php
    
    include 'dbconnect.php';
    include 'User.php';
    
    //getting registration values
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $name = $firstname." ".$lastname;

    $error = false;

    //if fields is empty
    if(empty($firstname) || empty($lastname) || empty($email) || empty($pass))
    {
        echo "Заповніть будь ласка усі поля<br>";
        $error = true;
    }

    //if email is not valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "Пошта не є валідною!<br>";
        $error = true;
    }

    //if email is already used
    if(User::strValueExists("email", $email, $conn))
    {
        echo "Ця пошта уже зайнята<br>";
        $error = true;
    }

    //if name is already used
    if(User::strValueExists("Name", $name, $conn))
    {
        echo "Це ім'я уже зайнято<br>";
        $error = true;
    }

    if(!$error) //if all was correct
    {
        if(User::addNewUser($name, $email, $pass, $conn)) //if registration was correct
        {
            echo "Реєстрація успішна.";
        }
    }
?>