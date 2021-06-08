<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\City;

class Airport extends Model
{
    use HasFactory;

    protected $table = "airport";

    public function city()
    {
        return $this->belongsTo(City::class, 'City_id');
    }
}
