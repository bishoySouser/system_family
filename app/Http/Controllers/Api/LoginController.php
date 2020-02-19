<?php

namespace App\Http\Controllers\Api;

use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $rule = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];
    public function login(Request $request){
        //validate
        $validate = Validator::make($request->all(), $this->rule);
        if ($validate->fails()) {
            return response()->json( ['errors'=> $validate->messages()],401);
        }
        return 'login';
    }
}
