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
            $query = "SELECT {$column} FROM {$table} WHERE {$condition}";
            //echo $query;
            
            $result = $conn->query($query)->fetch_array()[$column];
            
            return $result;
        }
    
        function updateColumn($column, $table, $value, $condition, $conn)
        {
            $query = "UPDATE {$table} SET {$column} = {$value} WHERE {$condition}";
            //echo $query;
            
            $result = $conn->query($query);
            
            return $result;
        }
    
        function addColumn($columns, $values, $table, $conn)
        {
            $query = "INSERT INTO `{$table}`({$columns}) VALUES($values)";
            //echo $query;
            
            $result = $conn->query($query);
            
            return $result;
        }
        
        
        //do we have a permission to use adminka?
        $hasPermission = getColumn('admin', '`user`', "email = '{$_COOKIE['email']}'", $conn);
        
        //how many passport requests we have
        $passport_requests_count = getColumn('COUNT(*)', 'passport_request', 'Confirmed IS NULL', $conn);
    
        //global var
        $pass_requests = $conn->query("SELECT * FROM passport_request WHERE Confirmed IS NULL");
        $users = $conn->query("SELECT * FROM `user`");
        $rooms = $conn->query(" SELECT rooms.id AS roomsId, rooms.CountRooms as countSubRooms, rooms.CountUsers AS CountUsers, 
                                hotel.Name AS hotelName, roomtype.Name AS roomType, rooms.User_id AS userID
                                FROM rooms
                                JOIN roomtype ON roomtype.idRoomtype = rooms.Roomtype_idRoomtype
                                JOIN hotel ON hotel.id = rooms.Hotel_id
                                ");
    
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
                $result = $result && updateColumn('passId', '`user`', "'{$newPassId}'", "id = {$user_id_request}", $conn);
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
    
        if(isset($_POST['action']))
        {
            $resultMsg = "";
            $result = true;
            
            if($_POST['action'] == 'make_admin') //making new admin
            {
                $user_id = $_POST['userID'];
                $result = updateColumn("admin", "`user`", "1", "id = {$user_id}", $conn);
            }
            //rooms
            else if($_POST['action'] == 'add_new_room') //add new room
            {
                $hotelID = $_POST['hotelID'];
                $roomtypeID = $_POST['roomtypeID'];
                $countSubRooms = $_POST['countSubRooms'];
                $countUsers = $_POST['countUsers'];
                
                $result = addColumn("Hotel_id, Roomtype_idRoomtype, CountRooms, CountUsers", 
                                    "{$hotelID}, {$roomtypeID}, {$countSubRooms}, {$countUsers}", 
                                    "rooms", $conn);
            }
            else if($_POST['action'] == "delete_room") //delete room
            {
                $roomID = $_POST['roomID'];
                echo $roomID;
            }
            
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
                            
                            while($request = $pass_requests->fetch_array())
                            {
                                echo "  <tr>
                                            <td>{$request['id']}</td>
                                            <td>{$request['User_id']}</td>
                                            <td>{$request['Name']}</td>
                                            <td>{$request['Sex']}</td>
                                            <td>{$request['PassID']}</td>
                                            <td>{$request['BirthDate']}</td>
                                            <td>{$request['InterPass']}</td>
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
                    <h1>Cities</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
                </div>
                <div class="contentDiv hidden" data-blockName="Airports">
                    <h1>Airports</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
                </div>
                <div class="contentDiv hidden" data-blockName="Hotels">
                    <h1>Hotels</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
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
                        
                            while($room = $rooms->fetch_array())
                            {
                                echo "  <tr>
                                            <td>{$room['roomsId']}</td>
                                            <td>{$room['hotelName']}</td>
                                            <td>{$room['roomType']}</td>
                                            <td>{$room['countSubRooms']}</td>
                                            <td>{$room['CountUsers']}</td>
                                            <td>{$room['userID']}</td>
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
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
                </div>
                <div class="contentDiv hidden" data-blockName="Flights">
                    <h1>Flights</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
                </div>
                <div class="contentDiv hidden" data-blockName="Planes">
                    <h1>Planes</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
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
                            while($user = $users->fetch_array())
                            {
                                echo "  <tr>
                                            <td>{$user['id']}</td>
                                            <td>{$user['Name']}</td>
                                            <td>{$user['RegistrationDate']}</td>
                                            <td>{$user['PassId']}</td>
                                            <td>{$user['Email']}</td>
                                            <td>{$user['Password']}</td>
                                            <td>{$user['admin']}</td>
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