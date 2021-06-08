<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Cookie;

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

                //we can now start session
                Cookie::queue("email", $email, 24*60);
            }
        }

        return response()->json([
            'correct_email' => $correct_email,
            'correct_pass' => $correct_pass
        ]);
    }

    public function registerUser(Request $request)
    {
        //data that user provided
        $name = $request->firstname." ".$request->lastname;
        $email = $request->email;
        $pass = $request->pass;

        //result of authorization
        $correct_name = User::where("Name", $name)->count() == 0;;
        $correct_email = User::where("Email", $email)->count() == 0;;
        $correct_pass = strlen($pass) >= 8;

        //if all data were correct
        if($correct_name && $correct_email && $correct_pass)
        {
            //creating new user
            $newUser = new User;

            $newUser->Name = $name;
            $newUser->Email = $email;
            $newUser->Password = $pass;

            $newUser->save();

            //we can now start session
            Cookie::queue("email", $email, 24*60);
        }
        
        return response()->json([
            "correct_name" => $correct_name,
            "correct_email" => $correct_email,
            "correct_pass" => $correct_pass
        ]);
    }

    public function loginStatus()
    {
        $loggined = Cookie::get("email") != null;

        return response()->json($loggined);
    }

    public function unlogin()
    {
        Cookie::queue(Cookie::forget('email'));
        return response()->json(true);
    }
}
