<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Roomtype;
use App\Models\Room;

class HotelsController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        $roomtypes = Roomtype::all();
        $rooms = Room::whereNull('User_id')->get();

        return view("main.hotels", [
            "hotels" => $hotels,
            "roomtypes" => $roomtypes,
            "rooms" => $rooms
        ]);
    }
}
