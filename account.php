<?php
    if(isset($_COOKIE['email'])) //if user already logined
    {
        include 'phpScripts/dbconnect.php';
        include 'phpScripts/generalScripts.php';
        include 'phpScripts/User.php';

        $user = new User($conn, $_COOKIE['email']);
        $allTickets = $user->getTicketsPurchased();
        
        echo "<table border='1px'>
                <tr>
                    <td>Reis</td>
                    <td>Place</td>
                </tr>";
        
        for($i = 0; $i < count($allTickets); $i++)
        {
            echo "  <tr>
                        <td>PS10{$allTickets[$i]['Reis_id1']}</td>
                        <td>{$allTickets[$i]['PlaceNumber']}</td>
                    </tr>"; 
        }
        
        echo "</table>";
    }
    else
    {
        gotoURL("../index.html"); 
    }

?>