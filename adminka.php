<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adminka</title>
    
    <!-- CSS -->
    <style>
        
        #mainTable
        {
            width: calc(100% + 50px);
            height: calc(110vh + 50px);
            background-color: lightblue;
            top: -10px;
            left: -10px;
            position: relative;
        }
        
        #contentTD
        {
            background-color: #6cf;
            height: 100%;
        }
        
        .navButton
        {
            width: 250px;
            font-size: 20px;
            height: 100px;
            background-color: #6cf;
            border: 1px solid lightblue;
            border-radius: 2px;
            margin: 20px;
        }
        
        .navButton:hover
        {
            cursor: pointer;
            background-color: antiquewhite;
        }
        
        .contentDiv
        {
            width: 100%;
            height: 100vh;
            text-align: justify;
        }
        
        .hidden
        {
            display: none;
        }
        
    </style>
    
    <!-- PHP -->
    <?php
        $address = "localhost";
        $user = "root";
        $pass = "root";
        $db = "airport";

        $conn = new mysqli($address, $user, $pass, $db);
        if($mysqli->connect_error)
        {
            echo "Some error occured with database.";
            exit();
        }
    
        function getColumn($column, $table, $condition, $conn)
        {
            $query = "SELECT {$column} FROM `{$table}` WHERE {$condition}";
            //echo $query;
            
            $result = $conn->query($query)->fetch_array()[$column];
            
            return $result;
        }
    
        function updateColumn($column, $table, $value, $condition, $conn)
        {
            $query = "UPDATE `{$table}` SET {$column} = {$value} WHERE {$condition}";
            //echo $query;
            
            $result = $conn->query($query);
            
            return $result;
        }
    
        function addRow($columns, $values, $table, $conn)
        {
            $query = "INSERT INTO `{$table}`({$columns}) VALUES($values)";
            //echo $query;
            
            $result = $conn->query($query);
            
            return $result;
        }
    
        function deleteRow($idcolumn, $id, $table, $conn)
        {
            $query = "DELETE FROM `{$table}` WHERE {$idcolumn}={$id}";
            //echo $query;
            
            $result = $conn->query($query);
            
            return $result;
        }
    
        function getFetchedArray($query, $conn)
        {
            $fetchedArray = [];
            
            try
            {
                $res = $conn->query($query);
                while($row = $res->fetch_array())
                {
                    $fetchedArray[count($fetchedArray)] = $row;
                }
            }
            catch(Exception $e)
            {
                echo "Error: {$e}";
            }
            
            return $fetchedArray;
        }
        
        
        //do we have a permission to use adminka?
        $hasPermission = getColumn('admin', 'user', "email = '{$_COOKIE['email']}'", $conn);
        
        $passport_requests_count = [];
        $pass_requests = [];
        $users = [];
        $rooms = [];
    
        if($hasPermission) //if you can`t access adminka, you still can use ctrl+u in order to see all info we have to hide
        {
            //how many passport requests we have
            $passport_requests_count = getColumn('COUNT(*)', 'passport_request', 'Confirmed IS NULL', $conn);
    
            //general data
            $pass_requests = getFetchedArray("SELECT * FROM passport_request WHERE Confirmed IS NULL", $conn);
            
            $users = getFetchedArray("SELECT * FROM `user`", $conn);
            
            $cities = getFetchedArray("SELECT * FROM city", $conn);
            
            $hotels = getFetchedArray(" SELECT hotel.id AS hotelId, hotel.Name AS hotelName, city.Name AS cityName, city.id AS cityId
                                        FROM hotel
                                        JOIN city ON city.id = hotel.City_id", $conn);
            
            $airports = getFetchedArray("   SELECT idAirport, airport.Name AS airportName, city.Name AS cityName, city.id AS cityId
                                            FROM airport
                                            JOIN city ON city.id = airport.City_id", $conn);
            
            $rooms = getFetchedArray("  SELECT rooms.id AS roomsId, rooms.CountRooms as countSubRooms, rooms.CountUsers AS CountUsers, 
                                        hotel.Name AS hotelName, roomtype.Name AS roomType, rooms.User_id AS userID
                                        FROM rooms
                                        JOIN roomtype ON roomtype.idRoomtype = rooms.Roomtype_idRoomtype
                                        JOIN hotel ON hotel.id = rooms.Hotel_id
                                        ", $conn);
            
            $roomtype = getFetchedArray("SELECT * FROM roomtype", $conn);
            
            $planes = getFetchedArray(" SELECT plane.id AS planeId, plane.Name AS planeName, plane.Count AS planeCount, 
                                        type.idType AS typeId, type.Name AS typeName
                                        FROM plane
                                        JOIN type ON type.idType = plane.Type_idType", $conn);
            
            $planetype = getFetchedArray("SELECT * FROM type", $conn);
            
            $flights = getFetchedArray("SELECT reis.id AS reisId, ReisNumber, ReservedCount, ReisTimeFrom, ReisTimeTo, Plane_id,                                                     Airport_idAirportFrom, Airport_idAirportTo, Price, aF.Name AS aFName, aT.Name AS aTName, 
                                        plane.Name AS planeName
                                        FROM reis
                                        JOIN airport AS aF ON reis.Airport_idAirportFrom = aF.idAirport
                                        JOIN airport AS aT ON reis.Airport_idAirportTo = aT.idAirport
                                        JOIN plane ON reis.Plane_id = plane.id
                                        ORDER BY reis.id", $conn);
        }
    
        //dealing with passport requests
        if(isset($_POST['actionPR']))
        {
            $actionStr = $_POST['actionPR'];
            $actionArray = explode(",", $actionStr);
            
            //what admin wants to do
            $passportRequestConfirm = $actionArray[0];
            $passportRequestID = $actionArray[1];
            $user_id_request = $_POST['userId'];
            $newPassId = $_POST['passId'];
            $result = false;
            
            $result = updateColumn('Confirmed', 'passport_request', "{$passportRequestConfirm}", "id = {$passportRequestID}", $conn);
                
            if($passportRequestConfirm) //if we need to CONFIRM passport
            {
                $result = $result && updateColumn('passId', 'user', "'{$newPassId}'", "id = {$user_id_request}", $conn);
            }
            
            $resultMsg = ""; //what we need to day to admin
            
            if($result) //if all were correct
            {
                $resultMsg = "Success!";
            }
            else
            {
                $resultMsg = "Something went wrong";
            }
            
            echo "  <script>
                        alert('{$resultMsg}');
                        location.replace(window.location);
                    </script>";
        }
    
        //all other actions
        if(isset($_POST['action']))
        {
            $resultMsg = "";
            $result = true;
            
            //-----user-----
            //make user an admin
            if($_POST['action'] == 'make_admin') 
            {
                $user_id = $_POST['userID'];
                $result = updateColumn("admin", "user", "1", "id = {$user_id}", $conn);
            }
            
            //create new user
            else if($_POST['action'] == 'add_user')
            {
                $name = $_POST['Name'];
                $pass = $_POST['Pass'];
                $email = $_POST['Email'];
                
                $result = addRow("Name, Password, Email", "'{$name}', '{$pass}', '{$email}'", "user", $conn);
            }
            
            //delete user
            else if($_POST['action'] == 'delete_user')
            {
                $id = $_POST['userID'];
                
                $result = deleteRow('id', $id, 'user', $conn);
            }
            
            //rooms
            else if($_POST['action'] == 'add_new_room') 
            {
                $hotelID = $_POST['hotelID'];
                $roomtypeID = $_POST['roomtypeID'];
                $countSubRooms = $_POST['countSubRooms'];
                $countUsers = $_POST['countUsers'];
                
                $result = addRow("Hotel_id, Roomtype_idRoomtype, CountRooms, CountUsers", 
                                    "{$hotelID}, {$roomtypeID}, {$countSubRooms}, {$countUsers}", 
                                    "rooms", $conn);
            }
            else if($_POST['action'] == 'delete_room') 
            {
                $roomID = $_POST['roomID'];
                $result = deleteRow('id', $roomID, 'rooms', $conn);
            }
            
            //city
            else if($_POST['action'] == 'add_new_city')
            {
                $cityName = $_POST['Name'];
                $cityCountry = $_POST['Country'];
                
                $result = addRow("Name, Country", "'{$cityName}', '{$cityCountry}'", "city", $conn);
            }
            else if($_POST['action'] == 'delete_city') 
            {
                $cityID = $_POST['cityID'];
                $result = deleteRow('id', $cityID, 'city', $conn);
            }
            
            //airports
            else if($_POST['action'] == 'add_new_airport')
            {
                $Name = $_POST['Name'];
                $cityID = $_POST['CityID'];
                            
                $result = addRow("Name, City_id", "'{$Name}', {$cityID}", "airport", $conn);
            }
            else if($_POST['action'] == 'delete_airport') 
            {
                $airportID = $_POST['airportID'];
                $result = deleteRow('idAirport', $airportID, 'airport', $conn);
            }
            
            //hotel
            else if($_POST['action'] == 'add_new_hotel')
            {
                $id = $_POST['HotelID'];
                $Name = $_POST['Name'];
                $cityID = $_POST['CityID'];
                            
                $result = addRow("id, Name, City_id", "{$id}, '{$Name}', {$cityID}", "hotel", $conn);
            }
            else if($_POST['action'] == 'delete_hotel')
            {
                $hotelID = $_POST['hotelID'];
                $result = deleteRow('id', $hotelID, 'hotel', $conn);
            }
            
            //roomtype
            else if($_POST['action'] == 'add_new_roomtype')
            {
                $id = $_POST['RoomtypeID'];
                $Name = $_POST['Name'];
                            
                $result = addRow("idRoomtype, Name", "{$id}, '{$Name}'", "roomtype", $conn);
            }
            else if($_POST['action'] == 'delete_roomtype')
            {
                $roomtypeID = $_POST['roomtypeID'];
                $result = deleteRow('idRoomtype', $roomtypeID, 'roomtype', $conn);
            }
            
            //-----planes-----
            //plane
            else if($_POST['action'] == 'add_new_plane')
            {
                $id = $_POST['PlaneID'];
                $Name = $_POST['Name'];
                $Count = $_POST['PlaneCount'];
                $TypeID = $_POST['TypeID'];
                            
                $result = addRow("id, Name, Count, Type_idType", "{$id}, '{$Name}', {$Count}, {$TypeID}", "plane", $conn);
            }
            else if($_POST['action'] == 'delete_plane')
            {
                $planeID = $_POST['planeID'];
                $result = deleteRow('id', $planeID, 'plane', $conn);
            }
            
            //planetype
            else if($_POST['action'] == 'add_new_planetype')
            {
                $id = $_POST['PlanetypeID'];
                $Name = $_POST['Name'];
                            
                $result = addRow("idType, Name", "{$id}, '{$Name}'", "type", $conn);
            }
            else if($_POST['action'] == 'delete_planetype')
            {
                $planetypeID = $_POST['planetypeID'];
                $result = deleteRow('idType', $planetypeID, 'type', $conn);
            }
            
            //-----flights-----
            else if($_POST['action'] == 'add_new_flight')
            {
                $reisNumber = $_POST['reisNumber'];
                $reisRC = $_POST['reisRC'];
                $reisTimeFrom = $_POST['timeFrom'];
                $reisTimeTo = $_POST['timeTo'];
                $planeID = $_POST['planeID'];
                $airportFromID = $_POST['airportFromID'];
                $airportToID = $_POST['airportToID'];
                $price = $_POST['Price'];
                            
                $result = addRow("ReisNumber, ReservedCount, ReisTimeFrom, ReisTimeTo, Plane_id, Airport_idAirportFrom, Airport_idAirportTo, Price ", 
                                 "{$reisNumber}, {$reisRC}, '{$reisTimeFrom}', '{$reisTimeTo}', {$planeID}, {$airportFromID}, {$airportToID}, {$price}", 
                                 "reis", $conn);
            }
            else if($_POST['action'] == 'delete_flight')
            {
                $flightID = $_POST['flightID'];
                $result = deleteRow('id', $flightID, 'reis', $conn);
            }
            
            //results
            if($result) //if all were correct
            {
                $resultMsg = "Success!";
            }
            else
            {
                $resultMsg = "Something went wrong";
            }
            
            echo "  <script>
                            alert('{$resultMsg}');
                            location.replace(window.location);
                        </script>";
        }
    ?>
    
    <!-- HTML&PHP -->
    
</head>
<body>
    <table border='0px' id='mainTable'>
        <tr>
            <td width='25%' align='center'>
                <button class="navButton" data-blockName="Main">Main</button>
                <hr>
            </td>
            <td rowspan="7" id='contentTD' valign="top">
               <!-- Contol blocks -->
                <div class="contentDiv" data-blockName="Main">
                    <h1>Welcome to adminka</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
                </div>
                <div class="contentDiv hidden" data-blockName="PassportRs">
                    <h1>Passport requests</h1>
                    <table border="1px">
                        <tr>
                            <td>Request ID</td>
                            <td>User ID</td>
                            <td>Name</td>
                            <td>Sex</td>
                            <td>Passport ID</td>
                            <td>Birthdate</td>
                            <td>International Passport ID</td>
                            <td></td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($pass_requests); $i++)
                            {
                                echo "  <tr>
                                            <td>{$pass_requests[$i]['id']}</td>
                                            <td>{$pass_requests[$i]['User_id']}</td>
                                            <td>{$pass_requests[$i]['Name']}</td>
                                            <td>{$pass_requests[$i]['Sex']}</td>
                                            <td>{$pass_requests[$i]['PassID']}</td>
                                            <td>{$pass_requests[$i]['BirthDate']}</td>
                                            <td>{$pass_requests[$i]['InterPass']}</td>
                                            <td>
                                                <form method='post'>
                                                    <button name='actionPR' value='1,{$request['id']}'>Accept</button>
                                                    <button name='actionPR' value='0,{$request['id']}'>Decline</button>
                                                    <input type='text' name='passId' style='display: none' value='{$request['PassID']}'>
                                                    <input type='text' name='userId' style='display: none' value='{$request['User_id']}'>
                                                </form>
                                                
                                            </td>
                                        </tr>";
                            }
                        
                        ?>
                    </table>
                </div>
                <div class="contentDiv hidden" data-blockName="Cities">
                    <h1>Cities</h1><br><br>
                    <h2>All cities list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>City name</td>
                            <td>Country</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($cities); $i++)
                            {
                                echo "  <tr>
                                            <td>{$cities[$i]['id']}</td>
                                            <td>{$cities[$i]['Name']}</td>
                                            <td>{$cities[$i]['Country']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new city</h2>
                    <form method="post">
                        <input type="text" name='Name' placeholder="city name" required>
                        <input type="text" name='Country' placeholder="country" required>
                        <button name="action" value="add_new_city">Add new city</button>
                    </form>
                    <hr>
                    <h2>Delete city</h2>
                    <form method="post">
                        <input type="text" name='cityID' placeholder="city id" required>
                        <button name="action" value="delete_city">Delete city</button>
                    </form>
                    
                </div>
                <div class="contentDiv hidden" data-blockName="Airports">
                    <h1>Airports</h1><br><br>
                    <h2>All airports list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>City Name</td>
                            <td>City ID</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($airports); $i++)
                            {
                                echo "  <tr>
                                            <td>{$airports[$i]['idAirport']}</td>
                                            <td>{$airports[$i]['airportName']}</td>
                                            <td>{$airports[$i]['cityName']}</td>
                                            <td>{$airports[$i]['cityId']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new airport</h2>
                    <form method="post">
                        <input type="text" name='Name' placeholder="airport name" required>
                        <input type="text" name='CityID' placeholder="city id" required>
                        <button name="action" value="add_new_airport">Add new airport</button>
                    </form>
                    <hr>
                    <h2>Delete airport</h2>
                    <form method="post">
                        <input type="text" name='airportID' placeholder="airport id" required>
                        <button name="action" value="delete_airport">Delete airport</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="Hotels">
                    <h1>Hotels</h1><br><br>
                    <h2>All hotels list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>City Name</td>
                            <td>City ID</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($hotels); $i++)
                            {
                                echo "  <tr>
                                            <td>{$hotels[$i]['hotelId']}</td>
                                            <td>{$hotels[$i]['hotelName']}</td>
                                            <td>{$hotels[$i]['cityName']}</td>
                                            <td>{$hotels[$i]['cityId']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new hotel</h2>
                    <form method="post">
                        <input type="text" name='HotelID' placeholder="hotel id" required>
                        <input type="text" name='Name' placeholder="hotel name" required>
                        <input type="text" name='CityID' placeholder="city id" required>
                        <button name="action" value="add_new_hotel">Add new hotel</button>
                    </form>
                    <hr>
                    <h2>Delete hotel</h2>
                    <form method="post">
                        <input type="text" name='hotelID' placeholder="hotel id" required>
                        <button name="action" value="delete_hotel">Delete hotel</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="Rooms">
                    <h1>Rooms</h1><br><br>
                    <h2>All rooms list</h2>
                    <table border='1px'>
                        <tr>
                            <td>id</td>
                            <td>Hotel</td>
                            <td>Roomtype</td>
                            <td>Count of subrooms</td>
                            <td>Max count of peoples</td>
                            <td>Reserved user id</td>
                        </tr>
                        <?php
                            for($i = 0; $i < count($rooms); $i++)
                            {
                                echo "  <tr>
                                            <td>{$rooms[$i]['roomsId']}</td>
                                            <td>{$rooms[$i]['hotelName']}</td>
                                            <td>{$rooms[$i]['roomType']}</td>
                                            <td>{$rooms[$i]['countSubRooms']}</td>
                                            <td>{$rooms[$i]['CountUsers']}</td>
                                            <td>{$rooms[$i]['userID']}</td>
                                        </tr>";
                            }
                                
                        ?>
                    </table>
                    <hr>
                    <h2>Add new room</h2>
                    <form method="post">
                        <input type="text" name='hotelID' placeholder="hotel id" required>
                        <input type="text" name='roomtypeID' placeholder="roomtype id" required>
                        <input type="text" name='countSubRooms' placeholder="count subrooms" required>
                        <input type="text" name='countUsers' placeholder="max peoples count" required>
                        <button name="action" value="add_new_room">Add new room</button>
                    </form>
                    <hr>
                    <h2>Delete room</h2>
                    <form method="post">
                        <input type="text" name='roomID' placeholder="room id" required>
                        <button name="action" value="delete_room">Delete room</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="RoomTypes">
                    <h1>Room types</h1>
                    <h2>All roomtypes list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($roomtype); $i++)
                            {
                                echo "  <tr>
                                            <td>{$roomtype[$i]['idRoomtype']}</td>
                                            <td>{$roomtype[$i]['Name']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new roomtype</h2>
                    <form method="post">
                        <input type="text" name='RoomtypeID' placeholder="roomtype id" required>
                        <input type="text" name='Name' placeholder="roomtype name" required>
                        <button name="action" value="add_new_roomtype">Add new roomtype</button>
                    </form>
                    <hr>
                    <h2>Delete roomtype</h2>
                    <form method="post">
                        <input type="text" name='roomtypeID' placeholder="roomtype id" required>
                        <button name="action" value="delete_roomtype">Delete roomtype</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="Flights">
                    <h1>Flights</h1>
                    <h2>All flights list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>Reis number</td>
                            <td>Reserved count</td>
                            <td>From time</td>
                            <td>To time</td>
                            <td>Plane id</td>
                            <td>Airport from id</td>
                            <td>Airport to id</td>
                            <td>Price</td>
                            <td>Plane name</td>
                            <td>Airport from name</td>
                            <td>Airport to name</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($flights); $i++)
                            {
                                echo "  <tr>
                                            <td>{$flights[$i]['reisId']}</td>
                                            <td>{$flights[$i]['ReisNumber']}</td>
                                            <td>{$flights[$i]['ReservedCount']}</td>
                                            <td>{$flights[$i]['ReisTimeFrom']}</td>
                                            <td>{$flights[$i]['ReisTimeTo']}</td>
                                            <td>{$flights[$i]['Plane_id']}</td>
                                            <td>{$flights[$i]['Airport_idAirportFrom']}</td>
                                            <td>{$flights[$i]['Airport_idAirportTo']}</td>
                                            <td>{$flights[$i]['Price']}</td>
                                            <td>{$flights[$i]['planeName']}</td>
                                            <td>{$flights[$i]['aFName']}</td>
                                            <td>{$flights[$i]['aFName']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new flight</h2>
                    <h4>Time example: 2021-05-15T14:30:00</h4>
                    <form method="post">
                        <input type="text" name='reisNumber' placeholder="reis number" required>
                        <input type="text" name='reisRC' placeholder="reis reserved count" required>
                        <input type="text" name='timeFrom' placeholder="reis departure time" required>
                        <input type="text" name='timeTo' placeholder="reis arrival time" required>
                        <input type="text" name='planeID' placeholder="plane id" required>
                        <input type="text" name='airportFromID' placeholder="departure airport id" required>
                        <input type="text" name='airportToID' placeholder="arrival airport id" required>
                        <input type="text" name='Price' placeholder="price" required>
                        <button name="action" value="add_new_flight">Add new flight</button>
                    </form>
                    <hr>
                    <h2>Delete flight</h2>
                    <form method="post">
                        <input type="text" name='flightID' placeholder="flight id" required>
                        <button name="action" value="delete_flight">Delete flight</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="Planes">
                    <h1>Planes</h1>
                    <h2>All planes list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Max passengers count</td>
                            <td>Planetype</td>
                            <td>Planetype id</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($planes); $i++)
                            {
                                echo "  <tr>
                                            <td>{$planes[$i]['planeId']}</td>
                                            <td>{$planes[$i]['planeName']}</td>
                                            <td>{$planes[$i]['planeCount']}</td>
                                            <td>{$planes[$i]['typeName']}</td>
                                            <td>{$planes[$i]['typeId']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new plane</h2>
                    <form method="post">
                        <input type="text" name='PlaneID' placeholder="plane id" required>
                        <input type="text" name='Name' placeholder="planetype name" required>
                        <input type="text" name='PlaneCount' placeholder="planetype count" required>
                        <input type="text" name='TypeID' placeholder="planetype id" required>
                        <button name="action" value="add_new_plane">Add new plane</button>
                    </form>
                    <hr>
                    <h2>Delete plane</h2>
                    <form method="post">
                        <input type="text" name='planeID' placeholder="plane id" required>
                        <button name="action" value="delete_plane">Delete plane</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="Planetypes">
                    <h1>Plane types</h1>
                    <h2>All planetypes list</h2>
                    <table border="1px">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                        </tr>
                        <?php
                            
                            for($i = 0; $i < count($planetype); $i++)
                            {
                                echo "  <tr>
                                            <td>{$planetype[$i]['idType']}</td>
                                            <td>{$planetype[$i]['Name']}</td>
                                        </tr>";
                            }
                            
                        ?>
                    </table>
                    <hr>
                    <h2>Add new planetype</h2>
                    <form method="post">
                        <input type="text" name='PlanetypeID' placeholder="planetype id" required>
                        <input type="text" name='Name' placeholder="planetype name" required>
                        <button name="action" value="add_new_planetype">Add new planetype</button>
                    </form>
                    <hr>
                    <h2>Delete planetype</h2>
                    <form method="post">
                        <input type="text" name='planetypeID' placeholder="planetype id" required>
                        <button name="action" value="delete_planetype">Delete planetype</button>
                    </form>
                </div>
                <div class="contentDiv hidden" data-blockName="Users">
                    <h1>Users</h1><br><br>
                    <h2>All users list</h2>
                    <table border='1px'>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Registration Date</td>
                            <td>Passport ID</td>
                            <td>Email</td>
                            <td>Password</td>
                            <td>admin</td>
                        </tr>
                        <?php
                            //displating all users
                            for($i = 0; $i < count($users); $i++)
                            {
                                echo "  <tr>
                                            <td>{$users[$i]['id']}</td>
                                            <td>{$users[$i]['Name']}</td>
                                            <td>{$users[$i]['RegistrationDate']}</td>
                                            <td>{$users[$i]['PassId']}</td>
                                            <td>{$users[$i]['Email']}</td>
                                            <td>{$users[$i]['Password']}</td>
                                            <td>{$users[$i]['admin']}</td>
                                        </tr>";
                            }
        
                        ?>
                    </table>
                    <hr>
                    <h2>Set user as admin</h2>
                    <form method="post">
                        <input type="text" placeholder="id of user" name='userID' required>
                        <button name="action" value='make_admin'>Make an admin</button>
                    </form>
                    <hr>
                    <h2>Add new user</h2>
                    <form method="post">
                        <input type="text" placeholder="Name" name='Name' required>
                        <input type="text" placeholder="Password" name='Pass' required>
                        <input type="text" placeholder="Email" name='Email' required>
                        <button name="action" value='add_user'>Add new user</button>
                    </form>
                    <hr>
                    <h2>Delete user</h2>
                    <form method="post">
                        <input type="text" placeholder="id of user" name='userID' required>
                        <button name="action" value='delete_user'>Delete user</button>
                    </form>
                    
                </div>
                
                
            </td>
        </tr>
        <!-- Navbar -->
        <tr>
            <td align='center'>
                <button class="navButton" data-blockName="PassportRs" style='margin-right: 0px'>Passport requests</button>
                <i style="font-size: 25px; color:green;"><?= $passport_requests_count ?></i>
                <hr>
            </td>
        </tr>
        <tr>
            <td align='center'>
                <button class="navButton" data-blockName="Cities">Cities</button>
                <button class="navButton" data-blockName="Airports">Airports</button>
                <hr>
            </td>        
        </tr>
        <tr>
            <td align='center'>
                <button class="navButton" data-blockName="Hotels">Hotels</button>
                <button class="navButton" data-blockName="Rooms">Rooms</button>
                <button class="navButton" data-blockName="RoomTypes">Room types</button>
                <hr>
            </td>  
        </tr>
        <tr>
            <td align='center'>
                <button class="navButton" data-blockName="Flights">Flights</button>
                <hr>
            </td>  
        </tr>
        <tr>
            <td align='center'>
                <button class="navButton" data-blockName="Planes">Planes</button>
                <button class="navButton" data-blockName="Planetypes">Planetypes</button>
                <hr>
            </td>  
        </tr>
        <tr>
            <td align='center'>
                <button class="navButton" data-blockName="Users">Users</button>
            </td>  
        </tr>
        
    </table>
</body>

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".navButton").on("click", function(){
            //getting block we need
            var block = $(this).attr("data-blockName");
            
            $(".contentDiv").addClass('hidden');
            $(".contentDiv[data-blockName='"+block+"']").removeClass('hidden');
        });
        
        //secure way to check user
        var hasPermision = "<?= $hasPermission ?>";
        if(hasPermision != 1)
        {
            $("#mainTable").html("У вас немає прав на цю панель. Зверніться до адміністратора.");
        }
    });
</script>

</html>