<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Roomtype;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";
    public $timestamps = false;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'Hotel_id');
    }

    public function roomtype()
    {
        return $this->belongsTo(Roomtype::class, 'Roomtype_idRoomtype', 'idRoomtype');
    }
}
