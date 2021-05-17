<?php

    class PassportRequest
    {
        public static function addNewRequest($conn, $name, $sex, $passId, $birthdate, $interPass, $userID, $replacing)
        {
            $query = "";
            $result = true;
            
            if($replacing) //deleteing previous if needed
            {
                $query = "DELETE FROM passport_request WHERE User_id = {$userID};";
            }
            $result = $conn->query($query);
            
            $query = " INSERT INTO passport_request(User_ID, Name, Sex, PassID, BirthDate, InterPass) 
                        VALUES({$userID}, '{$name}', '{$sex}', '{$passId}', '{$birthdate}', '{$interPass}');";
            $result = $conn->query($query);
            
            return $result;
        }
    }

?>