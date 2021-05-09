<?php
    echo "Hello maslyata!<br>";

    $username = "root";
    $password = "root";
    $address = "localhost";
    $db = "airport";

    $conn = new mysqli($address, $username, $password, $db);
    if($mysqli->connect_error)
    {
        printf("Error: ".$mysqli->connect_error);
        exit();
    }

    //airports
    $request = "SELECT idAirport, airport.Name AS airportName, city.Name AS cityName 
                FROM airport 
                JOIN city ON airport.City_Id = city.id 
                ORDER BY airport.idAirport";
    $result = $conn->query($request);

    echo "  <h1>Аеропорти</h1>
            <table border='1px'>
            <tr>
                <td>id</td>
                <td>Name</td>
                <td>City</td>
            </tr>";

    while($row = $result->fetch_array()) //making each row a associative array
    {
        echo "<tr>
                <td>{$row["idAirport"]}</td>
                <td>{$row["airportName"]}</td>
                <td>{$row["cityName"]}</td>
              </tr>";
    }

    echo "</table>";
    ///

    //hotels
    $request = "SELECT hotel.id AS hotelId, hotel.Name AS hotelName, city.Name AS cityName 
                FROM hotel 
                JOIN city ON hotel.City_Id = city.id 
                ORDER BY hotel.id";
    $result = $conn->query($request);

     echo "  <h1>Готелі</h1>
            <table border='1px'>
            <tr>
                <td>id</td>
                <td>Name</td>
                <td>City</td>
            </tr>";

    while($row = $result->fetch_array()) //making each row a associative array
    {
        echo "<tr>
                <td>{$row["hotelId"]}</td>
                <td>{$row["hotelName"]}</td>
                <td>{$row["cityName"]}</td>
              </tr>";
    }

    echo "</table>";
    ///

    //planes
    $request = "SELECT plane.id AS planeId, plane.Name AS planeName, plane.`Count` AS planeCount, type.Name AS typeName
                FROM plane 
                JOIN type ON plane.Type_idType = type.idType
                ORDER BY plane.id";
    $result = $conn->query($request);

     echo "  <h1>Літаки</h1>
            <table border='1px'>
            <tr>
                <td>id</td>
                <td>Name</td>
                <td>Count</td>
                <td>Type</td>
            </tr>";

    while($row = $result->fetch_array()) //making each row a associative array
    {
        echo "<tr>
                <td>{$row["planeId"]}</td>
                <td>{$row["planeName"]}</td>
                <td>{$row["planeCount"]}</td>
                <td>{$row["typeName"]}</td>
              </tr>";
    }

    echo "</table>"; 

    //users
    $request = "SELECT * FROM `user`";
    $result = $conn->query($request);

     echo " <h1>Користувачі</h1>
            <table border='1px'>
            <tr>
                <td>id</td>
                <td>Name</td>
                <td>Passport ID</td>
                <td>Pass</td>
                <td>Registration date</td>
            </tr>";

    while($row = $result->fetch_array()) //making each row a associative array
    {
        echo "<tr>
                <td>{$row["id"]}</td>
                <td>{$row["Name"]}</td>
                <td>{$row["PassId"]}</td>
                <td>{$row["Password"]}</td>
                <td>{$row["RegistrationDate"]}</td>
              </tr>";
    }

    echo "</table>";
    
?>