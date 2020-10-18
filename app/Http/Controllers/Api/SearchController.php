<?php

namespace App\Http\Controllers\Api;

use Validator;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    private $rules = [
        'search' => 'required'
    ];

    public function validateIndividual(array $arr){
        $validate = Validator::make($arr, $this->rules);
        return $validate;
    }

    public function individualName($search){
        $individuals = DB::table('individuals')
                                ->where(DB::raw("CONCAT(first_name,' ',middle_name,' ',last_name)"),"Like", $search."%")
                                ->orWhere('mobile_phone1', "like", $search."%")
                                ->orWhere('mobile_phone2', "like", $search."%");
        if($individuals->exists()){
            $reponse = [
                'msg' => 'individuals list',
                'individuals' => $individuals->get()
            ];
        }else{
            $reponse = [
                "msg" => "No search for ...  {$search} ",
                "individuals" => null
            ];
        }
        return response()->json($reponse, 201);  
    }

    public function getYoung($grander, $search){
        $individuals = DB::table('individuals')
                                ->where(DB::raw("CONCAT(first_name,' ',middle_name,' ',last_name)"),"Like", $search."%")
                                ->where('gander', $grander)
                                ->where('social_status', '<>', 'married')
                                ->whereNull('date_of_death');
                                
        if($individuals->exists()){
            $reponse = [
                'msg' => 'individuals list',
                'individuals' => $individuals->get()
            ];
        }else{
            $reponse = [
                "msg" => "No search for ...  {$search} ",
                "individuals" => null
            ];
        }
        return response()->json($reponse, 201);
    }

    /**
     * @param string first_name && middle_name
     * @param reponse children 
     */
    public function getChildren($first, $middle)
    {
        $childern = DB::table('individuals')
            ->select('id', 'first_name')
            ->where([
                ['middle_name', '=', $first],
                ['last_name' , '=', $middle]
                ]);

        $reponse = [
            'msg' => 'children list',
            'children' => $childern->get()
        ];

        return response()->json($reponse, 201);
    }
}
