<?php

namespace App\Http\Controllers\Api;

use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function register(Request $request){
        //check dublicated email
        if(User::where('email', $request->get('email'))->count() > 0){
            return response()->json(['msg' => 'User is exist.'], 400);
        }else{
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);
            $response = [
                'msg' => 'The Registration was successful!',
                'token' => $token
            ];
            return response()->json($response, 200);
        }


    }
}
