<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Cookie;

class AccountController extends Controller
{
    public function index()
    {
        $user = null;

        if(Cookie::get("email") != null)
        {
            $user = User::where("email", Cookie::get("email"))->first();
        }

        return view("main.account", [
            "user" => $user
        ]);
    }
     
    public function adminka()
    {
        return view('adminka', [
            "email" => Cookie::get("email")
        ]);
    }
}
