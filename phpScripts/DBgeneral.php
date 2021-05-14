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
        
        public function getAllHotels()
        {
            $result = $this->conn->query("  SELECT hotel.Name AS hotelName, city.Name AS cityName 
                                            FROM hotel
                                            JOIN city ON city.id = hotel.City_id"); 
            $hotels = [];
            
            while($row = $result->fetch_array()) 
            {
                $hotels[count($hotels)] = $row;
            }
            
            return $hotels;
        }
        
        public function getRooms($hotel, $roomtype)
        {
            $result = $this->conn->query("  SELECT city.Name AS cityName, hotel.Name AS hotelName, roomtype.Name AS roomtypeName, 
                                            rooms.CountRooms AS CountRooms, rooms.CountUsers AS CountUsers
                                            FROM rooms
                                            JOIN roomtype ON roomtype.idRoomtype = rooms.Roomtype_idRoomtype
                                            JOIN hotel ON rooms.Hotel_id = hotel.id
                                            JOIN city ON hotel.City_id = city.id
                                            WHERE hotel.Name = '{$hotel}' AND roomtype.Name = '{$roomtype}'"); 
            $hotels = [];
            
            while($row = $result->fetch_array()) 
            {
                $hotels[count($hotels)] = $row;
            }
            
            return $hotels;
        }
        
        public function getAllRooms()
        {
            $result = $this->conn->query("  SELECT city.Name AS cityName, hotel.Name AS hotelName, roomtype.Name AS roomtypeName, 
                                            rooms.CountRooms AS CountRooms, rooms.CountUsers AS CountUsers
                                            FROM rooms
                                            JOIN roomtype ON roomtype.idRoomtype = rooms.Roomtype_idRoomtype
                                            JOIN hotel ON rooms.Hotel_id = hotel.id
                                            JOIN city ON hotel.City_id = city.id"); 
            $hotels = [];
            
            while($row = $result->fetch_array()) 
            {
                $hotels[count($hotels)] = $row;
            }
            
            return $hotels;
        }
        
        public function getRoomTypes()
        {
            $result = $this->conn->query("SELECT roomtype.Name AS roomtypeName FROM roomtype"); 
            $roomTypes = [];
            
            while($row = $result->fetch_array()) 
            {
                $roomTypes[count($roomTypes)] = $row;
            }
            
            return $roomTypes;
        }
        
        public function getColumn($column, $table, $id)
        {
            $query = "SELECT {$column} FROM {$table} WHERE id={$id}";
            
            $result = $this->conn->query($query)->fetch_array()[$column];
            
            return $result;
        }
    }
    
?>