<?php

    class DBgeneral
    {
        public $conn;
        
        public function __construct($conn)
        {
            $this->conn = $conn;
        }
        
        public function getAllCities()
        {
            $result = $this->conn->query("SELECT city.Name AS cityName FROM city"); 
            $cities = [];
            
            while($row = $result->fetch_array()) 
            {
                $cities[count($cities)] = $row;
            }
            
            return $cities;
        }
    }
    
?>