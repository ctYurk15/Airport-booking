<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function authorizeUser(Request $request)
    {
        //data that user provided
        $email = $request->email;
        $pass = $request->pass;

        //result of authorization
        $correct_email = false;
        $correct_pass = false;

        $user = User::where("Email", $email)->first();

        //validating logged data
        if($user != null)
        {
            $correct_email = true;

            //we don`t need to check password if email is not correct
            if($user->Password == $pass)
            {
                $correct_pass = true;
            }
        }

        return response()->json([
            'correct_email' => $correct_email,
            'correct_pass' => $correct_pass
        ]);
    }
}
