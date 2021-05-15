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

    if(empty($firstname) || empty($lastname) || empty($sex) || empty($passId) || empty($dateOfBirth) || empty($interPassId))
    {
        echo "Заповніть будь ласка усі поля";
        $error = true;
    }

    if($dbgeneral->getColumn('id', 'passport_request', 'User_Id', $userID) != null)
    {
        echo "У вас уже є запит.";
        $error = true;
    }

    if(!$error) //if all were correct
    {
        $name = $firstname." ".$lastname;
        
        PassportRequest::addNewRequest($conn, $name, $sex, $passId, $dateOfBirth, $interPassID, $userID);
        echo "Запит успішно відправлено. Чекайте відповіді у наближчий час.";
    }
?>