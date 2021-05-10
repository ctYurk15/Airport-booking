<?php

    include 'dbconnect.php';
    include 'FlightsManager.php';

    $flightsManager = new FlightsManager($conn);

    $fromCity = $_POST['from'];
    $toCity = $_POST['to'];
    
    echo $fromCity." ".$toCity;

    $result = $flightsManager->getAllFlights($fromCity, $toCity);
                
    for($i = 0; $i < count($result); $i++)
    {
        echo "  <tr class='#'>
                <th>".$result[$i]['cFName']." - ".$result[$i]['cTName']."</th>
                <th>PS10".$result[$i]['ReisNumber']."</th>
                <th>".$result[$i]['fromTime']."</th>
                <th>".$result[$i]['toTime']."</th>
                <th>Loading...</th>
            </tr>";
    }
?>