<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reis;

class FlightsController extends Controller
{
    public function index(Request $request)
    {
        $flights = Reis::all();
        return view('main.flights',[
            "flights" => $flights
        ]);
    }
}
