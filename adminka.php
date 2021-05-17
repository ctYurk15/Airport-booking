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
            height: calc(100vh + 50px);
            background-color: lightblue;
            top: -10px;
            left: -10px;
            position: relative;
        }
        
        #contentTD
        {
            background-color: #6cf;
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
        
        //how many requests we have
        $query = "SELECT COUNT(*) AS count FROM passport_request WHERE Confirmed IS NULL";
        $passport_requests_count = $conn->query($query)->fetch_array()['count'];
    
        //dealing with passport requests
        if(isset($_POST['actionPR']))
        {
            $actionStr = $_POST['actionPR'];
            $actionArray = explode(",", $actionStr);
            
            //what admin wants to do
            $passportRequestConfirm = $actionArray[0];
            $passportRequestID = $actionArray[1];
            $user_id = $_POST['userId'];
            $newPassId = $_POST['passId'];
            $result = false;
            
            $query = "UPDATE passport_request SET Confirmed = {$passportRequestConfirm} WHERE id = {$passportRequestID};";
            $result = $conn->query($query);
                
            if($passportRequestConfirm) //if we need to CONFIRM passport
            {
                $query = " UPDATE `user` SET PassId = '{$newPassId}' WHERE id = {$user_id}";
                $result = $result && $conn->query($query);
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
            <td rowspan="6" id='contentTD' valign="top">
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
                            //displaying all requests
                            $result = $conn->query("SELECT * FROM passport_request WHERE Confirmed IS NULL");
                            
                            while($request = $result->fetch_array())
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
                    <h1>Rooms</h1>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum beatae unde, debitis quia ab vel, autem assumenda quisquam placeat illum quas. Earum nemo nihil, neque impedit ipsa libero doloremque, ratione beatae explicabo ab tenetur alias cumque dolorem at natus! Quibusdam cumque tempore odit optio laborum ipsum numquam tenetur dicta dolorum, expedita excepturi in, ullam velit delectus corrupti quae maiores obcaecati. Quos quis laborum quibusdam asperiores ullam. Quae officia ad fugit, quo dolores optio quos unde nam dolor, doloribus veritatis voluptate, nesciunt laudantium dolorem blanditiis. Laboriosam ea consequuntur eos accusamus quaerat hic quam porro. Repellat error explicabo numquam deserunt, repellendus ea!
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
        /*var hasPermision = "<?= $hasPermission ?>";
        if(hasPermision != 1)
        {
            $("#mainTable").html("У вас немає прав на цю панель. Зверніться до адміністратора.");
        }*/
    });
</script>

</html>