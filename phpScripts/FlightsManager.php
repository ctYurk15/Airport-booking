<?php

    class FlightsManager
    {
        public $conn;
        
        public function __construct($conn)
        {
            $this->conn = $conn;
        }
        
        public function getAllFlights($available = true, $fromCity = null, $toCity = null, $time = null)
        {
            $request = "SELECT cF.Name AS cFName, cT.Name AS cTName, reis.ReisNumber AS ReisNumber,
                        reis.ReisTimeFrom AS fromTime, reis.ReisTimeTo AS toTime 
                        FROM reis
                        JOIN airport AS aF ON reis.Airport_idAirportFrom = aF.idAirport
                        JOIN airport AS aT ON reis.Airport_idAirportTo = aT.idAirport
                        JOIN city AS cF ON aF.City_id = cF.id
                        JOIN city AS cT ON aT.City_id = cT.id
                        WHERE reis.ReisNumber > 0";
            
            //if we need to get flights you still can join
            if($available)
            {
                $request .= " AND reis.ReisTimeTo > current_timestamp() AND reis.ReisTimeFrom > current_timestamp()";
            }
            else
            {
                $request .= " AND reis.ReisTimeTo > current_timestamp() AND reis.ReisTimeFrom < current_timestamp()";
            }
            
            
            
            //if filters set
            if($fromCity != null && $fromCity != 'null')
            {
                $request .= " AND cF.Name = '{$fromCity}'";
            }
            if($toCity != null && $toCity != 'null')
            {
                $request .= " AND cT.Name = '{$toCity}'";
            }
            if($time != null && $time != 'null')
            {
                if($time == 'today')
                {
                    $request .= " AND(date(reis.reisTimeFrom) = date(NOW()) OR date(reis.ReisTimeTo) = date(NOW()))";
                }
                else if($time == 'tomorrow')
                {
                    $request .= " AND(date(reis.reisTimeFrom)-1 = date(NOW()) OR date(reis.ReisTimeTo)-1 = date(NOW()))";
                }
                else if($time == 'week')
                {
                    $request .= " AND(EXTRACT(WEEK FROM ReisTimeFrom) = EXTRACT(WEEK FROM NOW()) OR EXTRACT(WEEK FROM ReisTimeTo) = EXTRACT(WEEK FROM NOW()))";
                }
                else if($time == 'month')
                {
                    $request .= " AND(EXTRACT(MONTH FROM ReisTimeFrom) = EXTRACT(MONTH FROM NOW()) OR EXTRACT(MONTH FROM ReisTimeTo) = EXTRACT(MONTH FROM NOW()))";
                }
            }
            
            //echo $request;
            
            $result = $this->conn->query($request); 
            $fligths = [];
            
            while($row = $result->fetch_array()) 
            {
                $fligths[count($fligths)] = $row;
            }
            
            return $fligths;
        }
    }
?>