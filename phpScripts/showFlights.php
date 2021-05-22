<?php

    include 'dbconnect.php';
    include 'generalScripts.php';
    include 'FlightsManager.php';

    $flightsManager = new FlightsManager($conn);

    $fromCity = $_POST['from'];
    $toCity = $_POST['to'];
    $time = $_POST['time'];
    $available = ($_POST['available']);
    
    //echo $fromCity." ".$toCity;

    $result = $flightsManager->getAllFlights($available, $fromCity, $toCity, $time);
                
    for($i = 0; $i < count($result); $i++)
    {
        echo "<tr>
                <th>{$result[$i]['cFName']} - {$result[$i]['cTName']}</th>
                <th>PS10{$result[$i]['ReisNumber']}</th>
                <th>{$result[$i]['fromTime']}</th>
                <th>{$result[$i]['toTime']}</th>
                <th>Loading...</th>";
        if($available)
        {
            echo "<th class='reisTH'><button class='buyTicket' data-reisID='{$result[$i]['ReisNumber']}'>КУПИТИ</button></th>";
        }
        echo"</tr>";
    }
?>