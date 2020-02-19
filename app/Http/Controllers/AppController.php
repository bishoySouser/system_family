<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppController extends Controller
{
    public function init()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true))
        {
           
            return response()->json(Auth::user(), 200);
        }else{
            return response()->json(['error' => 'could not log you in.'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
    }

}
