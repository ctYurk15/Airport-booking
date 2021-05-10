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
        
        public function getColumn($column, $table, $id)
        {
            $query = "SELECT {$column} FROM {$table} WHERE id={$id}";
            
            $result = $this->conn->query($query)->fetch_array()[$column];
            
            return $result;
        }
    }
    
?>