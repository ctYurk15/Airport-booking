<?php
    
    include 'dbconnect.php';
    include 'PassportRequest.php';
    include 'User.php';
    include 'DBgeneral.php';

    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $sex = htmlspecialchars($_POST['sex']);
    $passId = htmlspecialchars($_POST['passId']);
    $dateOfBirth = htmlspecialchars($_POST['dateOfBirth']);
    $interPassId = htmlspecialchars($_POST['interPassId']);

    $user = new User($conn, $_COOKIE['email']);
    $dbgeneral = new DBgeneral($conn);

    $userID = $user->getColumn('id');

    $error = false;
    $replacing = false;

    if(empty($firstname) || empty($lastname) || empty($sex) || empty($passId) || empty($dateOfBirth) || empty($interPassId))
    {
        echo "Заповніть будь ласка усі поля";
        $error = true;
    }

    if($dbgeneral->getColumn('id', 'passport_request', 'User_Id', $userID) != null) //replacing previous request
    {
        $replacing = true;
    }

    if(!$error) //if all were correct
    {
        $name = $firstname." ".$lastname;
        
        if(PassportRequest::addNewRequest($conn, $name, $sex, $passId, $dateOfBirth, $interPassId, $userID, $replacing))
        {
            echo "Запит успішно відправлено. Чекайте відповіді у наближчий час.";
        }
        else
        {
            echo "Упс! Сталася помилка. Спробуйте ще раз пізніше.";
        }
    }
?>