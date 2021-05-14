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

   /* echo "  <tr class='#'>
                <th>Київ</th>
                <th>{$hotel}</th>
                <th>{$class}</th>
                <th>13</th>
                <th>13</th>
                <th><button>Замовити</button></th>
            </tr>";*/
        
    for($i = 0; $i < count($rooms); $i++)
    {
        echo "  <tr class='#'>
                    <th>{$rooms[$i]['cityName']}</th>
                    <th>{$rooms[$i]['hotelName']}</th>
                    <th>{$rooms[$i]['roomtypeName']}</th>
                    <th>{$rooms[$i]['CountRooms']}</th>
                    <th>{$rooms[$i]['CountUsers']}</th>
                    <th><button>Замовити</button></th>
                </tr>";
    }
?>