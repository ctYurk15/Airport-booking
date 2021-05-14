<?php
    
    include 'dbconnect.php';
    include 'PassportRequest.php';
    include 'User.php';

    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $sex = htmlspecialchars($_POST['sex']);
    $passId = htmlspecialchars($_POST['passId']);
    $dateOfBirth = htmlspecialchars($_POST['dateOfBirth']);
    $interPassId = htmlspecialchars($_POST['interPassId']);

    $error = false;

    if(empty($firstname) || empty($lastname) || empty($sex) || empty($passId) || empty($dateOfBirth) || empty($interPassId))
    {
        echo "Заповніть будь ласка усі поля";
        $error = true;
    }

    if(!$error) //if all were correct
    {
        $user = new User($conn, $_COOKIE['email']);
        $userID = $user->getColumn('id');
        $name = $firstname." ".$lastname;
        
        PassportRequest::addNewRequest($conn, $name, $sex, $passId, $dateOfBirth, $interPassID, $userID);
        echo "Запит успішно відправлено. Чекайте відповіді у наближчий час.";
    }
?>