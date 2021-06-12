<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "ticket";

    protected $fillable = ['PlaceNumber', 'Reis_id1', 'User_id'];

    public $timestamps = false;
}
