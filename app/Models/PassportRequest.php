<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportRequest extends Model
{
    use HasFactory;

    protected $table = "passport_request";

    public $timestamps = false;

    protected $fillable = [
        "Name", "Sex", "PassID", "BirthDate", "InterPass", "User_id"
    ];
}
