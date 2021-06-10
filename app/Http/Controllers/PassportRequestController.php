<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassportRequest;
use App\Models\User;
use Cookie;

class PassportRequestController extends Controller
{
    public function addPR(Request $request)
    {
        //forming array of field needed for KYC request
        $params = $request->all();
        $user_id = User::where("email", Cookie::get("email"))->first()->id;
        $params['User_id'] = $user_id;

        //if there is already some request
        $request = PassportRequest::where('User_id', $user_id)->first();
        if($request != null && $request->count() > 0)
        {
            //deleting previous request
            $request->delete();
        }

        //creating new KYC request
        PassportRequest::create($params);

        return response()->json(true);
    }
}
