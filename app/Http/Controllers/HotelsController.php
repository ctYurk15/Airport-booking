<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Roomtype;
use App\Models\Room;

class HotelsController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::all();
        $roomtypes = Roomtype::all();
        $rooms = Room::whereNull('User_id')->get();

        //if sortind is defined
        $hotelName = $request->hotel;
        $roomtype = $request->room_class;

        $filtered_rooms = [];

        foreach($rooms as $room)
        {
            $fits = true;

            //if room has needed parameters
            if(isset($hotelName) && $hotelName != 'any' && $room->hotel->Name != $hotelName)
            {
                $fits = false;
            }

            if(isset($roomtype) && $roomtype != 'any' && $room->roomtype->Name != $roomtype)
            {
                $fits = false;
            }

            if($fits)
            {
                array_push($filtered_rooms, $room);
            }
        }

        if($request->ajax())
        {
            return view("ajax.ajax_hotels", [
                "rooms" => $filtered_rooms
            ])->render();
        }

        return view("main.hotels", [
            "hotels" => $hotels,
            "roomtypes" => $roomtypes,
            "rooms" => $filtered_rooms
        ]);
    }
}
