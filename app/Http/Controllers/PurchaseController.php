<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reis;
use App\Models\User;
use App\Models\Room;
use App\Models\Ticket;
use Cookie;

class PurchaseController extends Controller
{
    public function purchaseTicket(Request $request)
    {
        $current_reis = Reis::find($request->Reis_id1);
        $current_user = User::where("email", Cookie::get("email"))->first();

        if($current_user->PassId != null) //if user is verified
        {
            //forming array for new ticket
            $request['PlaceNumber'] = $current_reis->ReservedCount; //place number is get from already reserved count, and then ReservedCount increases so users won`t have same place
            $current_reis->ReservedCount++;
            $current_reis->save();

            $request['User_id'] = $current_user->id;

            Ticket::create($request->all());

            return response()->json(["result" => true, 'reis_id' => $request->Reis_id1]);
        }

        return response()->json(["result" => false, 'message' => 'passport_null']);
    }

    public function purchaseRoom(Request $request)
    {
        $current_room = Room::find($request->room_id);
        $current_user = User::where("email", Cookie::get("email"))->first();

        if($current_user->PassId != null) //if user is verified
        {
            if($current_room->User_id == null) //if room is not booked yet
            {
                //now this room is booked by current user
                $current_room->User_id = $current_user->id;
                $current_room->save();

                return response()->json(["result" => true, 'hotel' => $current_room->hotel->Name, 'type' => $current_room->roomtype->Name]);
            }

            return response()->json(["result" => false, 'message' => 'room_booked']);
        }

        return response()->json(["result" => false, 'message' => 'passport_null']);
    }
}
