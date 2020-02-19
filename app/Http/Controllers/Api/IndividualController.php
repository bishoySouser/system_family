<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Individual;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndividualController extends Controller
{
    private $rules = [
        "first_name" => 'required|string',
        "middle_name" => 'required|string',
        "last_name" => 'required|string',
        "gander" => 'required|in:male,female',
        "date_of_birth" => 'required|date|before_or_equal:today',
        "date_of_death" => 'nullable|date|before_or_equal:today',
        "place_of_birth" => 'required|',
        "area" => 'required|string',
        "address" => 'required|string',
        "home_phone" => 'required|regex:/(2)[0-9]{8}/',
        "mobile_phone1" => 'required|regex:/(1)[0-9]{9}/',
        "mobile_phone2" => 'nullable|regex:/(1)[0-9]{9}/',
        "job" => 'nullable|string',
        "social_status" => 'required|in:single,married,widower,dead',
        "special" => 'nullable|boolean'
    ];
    
    // create new Individual
    public function newIndividual(array $arr){
        $individual = new Individual;
        
        $individual->first_name = $arr['first_name'];
        $individual->middle_name = $arr['middle_name'];
        $individual->last_name = $arr['last_name'];
        $individual->gander = $arr['gander'];
        $individual->date_of_birth = $arr['date_of_birth'];
        $individual->place_of_birth = $arr['place_of_birth'];
        $individual->area = $arr['area'];
        $individual->address = $arr['address'];
        $individual->home_phone = $arr['home_phone'];
        $individual->mobile_phone1 = $arr['mobile_phone1'];
        $individual->social_status = $arr['social_status'];

        //property is nullable
        $individual->job = isset($arr['job']) ? $arr['job'] : null;
        $individual->date_of_death = isset($arr['date_of_death']) ? $arr['date_of_death'] : null;
        $individual->special = isset($arr['special']) ? $arr['special'] : null;

        return $individual->save();
        
    }
    // validate method
    //@array $arr
    public function validateIndividual(array $arr){
        $validate = Validator::make($arr, $this->rules);
        return $validate;
    }
    public function insertIndividual(Request $request){
        //check validate
        $validate = self::validateIndividual($request->all());
        if(self::validateIndividual($request->all())->fails()){
            return response()->json(['error' => $validate->messages()], 401);
        }
        $request = $request->toArray(); // get array $request
        
        if(!self::newIndividual($request)){
            return response()->json(['error' => 'User don\'t add.'], 401);
        }else{
            return response()->json(['message' => 'User is add.'], 201);
        }
    }
}
