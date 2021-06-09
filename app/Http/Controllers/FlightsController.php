<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reis;
use App\Models\City;

class FlightsController extends Controller
{
    public function sortFlights($flights, $fromCity, $toCity, $time)
    {
        $result = [];

        $date = today()->format('Y-m-d');

        foreach($flights as $flight)
        {
            $fits = true;

            //if departure city is right
            if(isset($fromCity) && $fromCity != 'any' && $flight->departureAirport->city->Name != $fromCity)
            {
                $fits = false;
            }
            
            //if arrival city is right
            if(isset($toCity) && $toCity != 'any' && $flight->arrivalAirport->city->Name != $toCity)
            {
                $fits = false;
            }

            //if time is right
            if(isset($time) && $time != 'any')
            {
               if($time == 'today' && ($flight->ReisTimeFrom->format('Y-m-d') != $date && $flight->ReisTimeTo->format('Y-m-d') != $date))
               {
                   $fits = false;
               }
               else if($time == 'tomorrow' && ($flight->ReisTimeFrom->format('Y-m-d') != date('Y-m-d', strtotime( "+1 days")) && $flight->ReisTimeTo->format('Y-m-d') != date('Y-m-d', strtotime( "+1 days"))))
               {
                   $fits = false;
               }
               else if($time == 'week' && ($flight->ReisTimeFrom->format('W') != today()->format('W') && $flight->ReisTimeTo->format('W') != today()->format('W')))
               {
                   $fits = false;
               }
               else if($time == 'month' && ($flight->ReisTimeFrom->format('Y-m') != date('Y-m') && $flight->ReisTimeTo->format('Y-m') != date('Y-m')))
               {
                   $fits = false;
               }
            }

            if($fits)
            {
                array_push($result, $flight);
            }
        }
        return $result;
    }

    public function index(Request $request)
    {
        $date = today()->format('Y-m-d');

        //filters user set
        $fromCity = $request->fromCity;
        $toCity = $request->toCity;
        $time = $request->time;

        //got all valid info
        $available_flights = Reis::where('ReisTimeFrom', '>=', $date)->get();
        $arriving_flights = Reis::where('ReisTimeTo', '>=', $date)->where('ReisTimeFrom', '<=', $date)->get();
        $cities = City::all();

        //filtering it
        $available_flights_filtered = $this->sortFlights($available_flights, $fromCity, $toCity, $time);
        $arriving_flights_filtered = $this->sortFlights($arriving_flights, $fromCity, $toCity, $time);

        if($request->ajax())
        {
            return view('ajax.ajax_flights',[
                "available_flights" => $available_flights_filtered,
                "arriving_flights" => $arriving_flights_filtered
            ])->render();
            //return response()->json([$available_flights_filtered, $arriving_flights_filtered]);
        }

        return view('main.flights',[
            "available_flights" => $available_flights_filtered,
            "arriving_flights" => $arriving_flights_filtered,
            "cities" => $cities
        ]);
    }
}
