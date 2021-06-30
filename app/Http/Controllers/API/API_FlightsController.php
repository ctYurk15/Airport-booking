<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reis;
use App\Models\Airport;

class API_FlightsController extends Controller
{
    //replacing airport ID with airport NAME
    private function prepareFlight(&$flight)
    {
        //adding airport names
        $flight['AirportFrom'] = Airport::where('idAirport', $flight->Airport_idAirportFrom)->first()->Name;
        $flight['AirportTo'] = Airport::where('idAirport', $flight->Airport_idAirportTo)->first()->Name;

        //deleting airport ids
        unset($flight->Airport_idAirportFrom);
        unset($flight->Airport_idAirportTo);
    }

    public function index()
    {
        $flights = Reis::all();

        foreach($flights as $flight)
        {
            $this->prepareFlight($flight);
        }

        return response()->json($flights, 200);
    }

    public function show(Request $request)
    {
        $flight = Reis::find($request->flight);

        //if flight is not exist
        if($flight == null)
        {
            return response()->json(["result" => false, "message" => "The flight is not exists"], 404);
        }

        return response()->json($flight, 200);
    }
}
