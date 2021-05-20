<?php

    include 'dbconnect.php';
    include 'User.php';
    include 'generalScripts.php';
    
    //what user wants to do
    $action = $_POST['action'];
    $start_markup = $_POST['start_markup'];

    //user we`re working with
    $user = new User($conn, $_COOKIE['email']);

    if($action == "get_tickets")
    {
        echo json_encode(array('tickets' => $user->getTicketsPurchased() ));
    }
    else if($action == "hotel_rooms")
    {
        echo json_encode(array('rooms' => $user->getRoomsReserved() ));
    }

    
    
    //writing star markup needed
    /*echo $start_markup;

    if($action == "get_tickets") //what we need to do next
    {
        $allTickets = $user->getTicketsPurchased();

        for($i = 0; $i < count($allTickets); $i++)
        {
            echo "  <tr>
                        <td>PS10{$allTickets[$i]['Reis_id1']}</td>
                        <td>{$allTickets[$i]['PlaceNumber']}</td>
                    </tr>"; 
        }
    }
    else if($action == "hotel_rooms")
    {
        $allRooms = $user->getRoomsReserved();

        for($i = 0; $i < count($allRooms); $i++)
        {
            echo "  <tr>
                        <td>{$allRooms[$i]['hotelName']}</td>
                        <td>{$allRooms[$i]['roomtypeName']}</td>
                    </tr>"; 
        }
    }*/

    

   // exit();
    
    /**/

?>