<?php

    include 'dbconnect.php';
    include 'DBgeneral.php';

    $hotel = $_POST['hotel'];
    $class = $_POST['class'];

    $dbgeneral = new DBgeneral($conn);
    $rooms = [];

    if(empty($hotel) || empty($class))
    {
        $rooms = $dbgeneral->getAllRooms();
    }
    else 
    {
        $rooms = $dbgeneral->getRooms($hotel, $class);
    }
        
    for($i = 0; $i < count($rooms); $i++)
    {
        echo "  <tr class='#'>
                    <th>{$rooms[$i]['cityName']}</th>
                    <th>{$rooms[$i]['hotelName']}</th>
                    <th>{$rooms[$i]['roomtypeName']}</th>
                    <th>{$rooms[$i]['CountRooms']}</th>
                    <th>{$rooms[$i]['CountUsers']}</th>
                    <th><button data-idRoom='{$rooms[$i]['idRoom']}' class='reserveRoom'>Замовити</button></th>
                </tr>";
    }
?>