<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Individual;
use App\Family;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    private $rules = [
        'father' => 'required|unique:families,father_id',
        'mather' => 'required|unique:families,mather_id',
        'marriage_feast' => 'required|date|before_or_equal:today'
    ];
    private function validateFamily(array $arr){
        $validate = Validator::make($arr, $this->rules);
        return $validate;
    }
    private function validateFatherAndMather($father, $mather){
        $fatherGrander = Individual::findOrFail($father,'gander');
        $matherGrander = Individual::findOrFail($mather,'gander');
        if($fatherGrander->gander != 'male' || $matherGrander->gander != 'female'){
            return false;
        }
        return true;
    }
    private function insertFamily($father, $mather, $marriage_feast){
        $family = new Family;
        $family->father_id = $father;
        $family->mather_id = $mather;
        $family->family_date_from = $marriage_feast;
        return $family;
    }
    public function addFamily(Request $request){
        $father = $request->input('father');
        $mather = $request->input('mather');
        $marriage_feast = $request->input('marriage_feast');
        //validate
        $validate = self::validateFamily($request->all());
        if($validate->fails()){
            return response()->json(['error' => $validate->messages()], 401);
        }
        // check father is male and mather is female
        if(!$this->validateFatherAndMather($father, $mather)){
            return response()->json(['error' => 'The father must be a man & the mother is a woman.']);
        }
        $family = $this->insertFamily($father, $mather, $marriage_feast);
        if($family->save()){
            Individual::whereIn('id', [$father, $mather])
                        ->update(['social_status' => 'married']);

            $response = [
                'msg' => 'Family add',
                'id' => 'family/'.$family->id
            ];
            return response()->json($response, 200);
        }
        // return Individual::findOrFail($request->input('father'),'gander');
    }

    //get family -> id
    public function getFamily($id){
        $family = family::findOrFail($id);
        $family->father;
        $family->mather;
        $response = [
            'msg' => 'get family',
            'family' => $family
        ];
        return response()->json($response, 200);
    }
    //All Family
    public function getFamilies(){
        $families = family::all();
        //Eager Loading
        foreach($families as $family){
            $family->father;
            $family->mather;
        }
        $response = [
            'msg' => 'All Families',
            'families' => $families
        ];

        return response()->json($response, 200);
    }
    //edit family
    public function editFamily($id, Request $request){
        $family = Family::findOrFail($id);
        //validate
        
        if($family->father_id == $request->input("father") && $family->mather_id == $request->input("mather")){
            $this->rules = [
                'marriage_feast' => 'required|date|before_or_equal:today'
            ];
        }
        $validate = self::validateFamily($request->all());
        if($validate->fails()){
            return response()->json(['error' => $validate->messages()], 401);
        }
        //update
        $family->father_id = $request->input("father");
        $family->mather_id = $request->input("mather");
        $family->family_date_from = $request->input("marriage_feast");
        if($family->save()){

            return response()->json(['msg' => 'Information updated!'], 200);
        }
    }
    //delete family
    public function deleteFamily($id){
        $family = Family::findOrFail($id);
        if($family->delete()){
            return response()->json(["msg" => "Family Deleted!"], 200);
        }
    }
}
