<?php
    class User
    {
        public $conn;
        public $email;
        
        public function __construct($conn, $email)
        {
            $this->conn = $conn;
            $this->email = $email;
        }
        
        public function isColumnNull($column)
        {
            $query = "SELECT {$column} IS NULL AS columnSet FROM user WHERE Email='{$this->email}';";
            
            $result = $this->conn->query($query)->fetch_array()['columnSet'];
            
            return $result;
        }
        
        public function getColumn($column)
        {
            $query = "SELECT {$column} FROM `user` WHERE Email='{$this->email}'";
                
            $result = $this->conn->query($query)->fetch_array()[$column];
            
            return $result;
        }
        
        public function purchaseTicket($reisID, $place)
        {
            $userID = $this->getColumn('id');
            
            //creating new ticked
            $query = "INSERT INTO ticket(PlaceNumber, User_id, Reis_id1) VALUES({$place}+1, {$userID}, {$reisID})";
            $this->conn->query($query);
            
            //adding +1 to reservation
            $query = "UPDATE reis SET ReservedCount = ReservedCount+1 WHERE id={$reisID}";
            $this->conn->query($query);
        }
        
        public function getTicketsPurchased()
        {
            $tickets = [];
            $query = "  SELECT ticket.* 
                        FROM ticket 
                        JOIN `user` ON `user`.id = ticket.User_id
                        WHERE `user`.email = '{$this->email}'";
            
            $result = $this->conn->query($query);
            
            while($row = $result->fetch_array())
            {
                $tickets[count($tickets)] = $row;
            }
            
            return $tickets;
        }
        
        public function orderRoom($roomID)
        {
            $userID = $this->getColumn('id');
            
            $query = "UPDATE rooms SET User_id={$userID} WHERE id={$roomID}";
            $this->conn->query($query);
        }
        
        public function getRoomsReserved()
        {
            $rooms = [];
            $query = "  SELECT roomtype.Name AS roomtypeName, hotel.Name AS hotelName
                        FROM rooms
                        JOIN hotel ON hotel.id = rooms.Hotel_id
                        JOIN roomtype ON roomtype.idRoomtype = rooms.Roomtype_idRoomtype
                        JOIN `user` ON `user`.id = rooms.User_id
                        WHERE `user`.email = '{$this->email}'";
            
            $result = $this->conn->query($query);
            
            while($row = $result->fetch_array())
            {
                $rooms[count($rooms)] = $row;
            }
            return $rooms;
            
        }
        
        
        //all users functions
        public static function addNewUser($name, $email, $pass, $conn)
        {
            $conn->query("INSERT INTO `user`(Name, Password, Email) VALUES('{$name}', '{$pass}', '{$email}');");
            return true;
        }
        
        public static function strValueExists($column, $value, $conn)
        {
            $count = 0;
            $result = false;
            
            $count = $conn->query("SELECT COUNT(*) AS count FROM `user` WHERE {$column} = '{$value}'")->fetch_array()['count'];
            $count == 0 ? ($result = false) : ($result = true);
            
            return $result;
        }
        
        public static function correctLogin($email, $pass, $conn)
        {
            $correct = false;
            
            if(User::strValueExists("email", $email, $conn)) //email validation
            {
                //password validation
                $dbPass = $conn->query("SELECT Password FROM `user` WHERE email = '{$email}'")->fetch_array()['Password'];
                if($dbPass == $pass)
                {
                    $correct = true;
                }
            }
            
            return $correct;
        }
    }
?>