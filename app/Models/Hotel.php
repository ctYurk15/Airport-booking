<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Hotel extends Model
{
    use HasFactory;

    protected $table = "hotel";

    public function city()
    {
        return $this->belongsTo(City::class, 'City_id');
    }
}
