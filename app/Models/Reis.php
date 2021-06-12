<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Airport;

class Reis extends Model
{
    use HasFactory;

    protected $table = "reis";
    protected $dates = ['ReisTimeFrom', 'ReisTimeTo'];
    public $timestamps = false;

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'Airport_idAirportFrom', 'idAirport');
    }
    
    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'Airport_idAirportTo', 'idAirport');
    }
    
}
