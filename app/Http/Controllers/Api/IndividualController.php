<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Individual;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndividualController extends Controller
{
    private $rules = [
        "first_name" => 'required|string',
        "middle_name" => 'required|string',
        "last_name" => 'required|string',
        "email" => 'nullable|email',
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
    private $list_null = [
        'email',
        'job',
        'mobile_phone2',
        'date_of_death',
        'special'
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
        $individual->email = isset($arr['email']) ? $arr['email'] : null;
        $individual->job = isset($arr['job']) ? $arr['job'] : null;
        $individual->mobile_phone2 = isset($arr['mobile_phone2']) ? $arr['mobile_phone2'] : null;
        $individual->date_of_death = isset($arr['date_of_death']) ? $arr['date_of_death'] : null;
        $individual->special = isset($arr['special']) ? $arr['special'] : null;

        return $individual->save();
        
    }
    // validate method
    //@array $arr
    public function validateIndividual(array $request){
        $validate = Validator::make($request, $this->rules);
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

    public function getIndividuals(){
        $individuals = Individual::orderBy('date_of_birth', 'desc')->get();
        $response = [
            'msg' => 'get all individuals',
            'individuals' => $individuals
        ];
        if($individuals->count() == 0){
            return response()->json($response, 204);
        }
        return response()->json($response, 200);
    }

    public function editIndividual($id, request $request){
        $individual = Individual::findOrFail($id);
        $validate = self::validateIndividual($request->all());
        if(self::validateIndividual($request->all())->fails()){
            return response()->json(['error' => $validate->messages()], 401);
        }
        //if requests are null, Request can't insert with method 
        foreach($this->list_null as $item){
            if($request->has($item)){
                $request->item = $request->item;
            }
        }

        $input = $request->all();
        $individual->fill($input)->save();

        return response()->json(['msg' => 'Information updated!'], 200);
        
    }

    public function getIndividual($id){
        $individual = Individual::findOrFail($id);
        $response = [
            'msg' => 'get individual',
            'individual' => $individual
        ];
        return response()->json($response, 200);
    }

    public function deleteIndividual($id){
        $id = [1];
        $ids = explode(',', $id);
        var_dump($ids);
        dd();
        $individuals = Individual::whereIn('id', $id)->get();
        if($individuals->delete()){
            return response()->json(['msg' => 'Individual Deleted!'], 200);
        }
    }
}
