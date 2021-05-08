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
        
        public static function addNewUser($firstname, $lastname, $email, $pass, $conn)
        {
            $name = $firstname." ".$lastname;
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
    }
?>