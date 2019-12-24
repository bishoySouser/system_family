<?php

namespace App\Http\Controllers\Api;

use App\User;
use JWTAuth;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{   
    protected $rule = [
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'password_confirm' => 'required|same:password'
    ];

    public function register(Request $request){
        //validate
        $validator = Validator::make($request->all(), $this->rule);
        if ($validator->fails()) {
            return response()->json( ['errors'=> $validator->messages()],401);
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
