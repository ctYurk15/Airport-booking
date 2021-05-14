<?php

    class PassportRequest
    {
        public static function addNewRequest($conn, $name, $sex, $passId, $birthdate, $interPass, $userID)
        {
            $query = "  INSERT INTO passport_request(User_ID, Name, Sex, PassID, BirthDate, InterPass) 
                        VALUES({$userID}, '{$name}', '{$sex}', '{$passId}', '{$birthdate}', '{$birthdate}');";
            $conn->query($query);
        }
    }

?>