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