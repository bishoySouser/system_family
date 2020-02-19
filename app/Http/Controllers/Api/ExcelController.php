<?php

namespace App\Http\Controllers\Api;

use Validator;
use Excel;
use App\Http\Controllers\Api\IndividualController as IndividualCon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{
    protected $rules = [
        'file' => 'required|mimes:xls,xlsx,csv',
    ];
    
    protected $headerRow = [
            "first_name",
            "middle_name",
            "last_name",
            "gander",
            "date_of_birth",
            "place_of_birth",
            "email",
            "area",
            "address",
            "home_phone",
            "mobile_phone1",
            "mobile_phone2",
            "social_status",
            "job"
        ];

    protected function validateExcel($request){
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()){
            return response()->json( ['error' => $validate->messages()], 401);
        }
        return false;
    }

    protected function getFileData($file){
        $path = $file->getRealPath();
        // get data
        $data = Excel::load($path)->get();
        // check file empty
        $data = $data[0];
        if(count($data) == 0){
            return response()->json(['error', 'the file is empty.'], 401);
        }
        //select header row
        $headerRow = $data->first()->keys()->toArray();
        //get All Date
        $all_data = $data->toArray();
        // check header row (Count)
        if(count($headerRow) != count($this->headerRow)){
            return response()->json(['error' => 'must to be file has 12 column.'], 401);
        }else{
            $headerRow_key = 0; // counter array $this->headerRow
            foreach($headerRow as $key){
                // check header row (Name)
                if($key != $this->headerRow[$headerRow_key]){
                    return response()->json(['error' => 'must file like this file.'] , 401);
                }
                $headerRow_key++;
            }
        }
        $line_row = 2;// line row sheet
        $individualCon = new IndividualCon;
        //validate all data in excel file
        foreach($all_data as $key=>$value){
            //validate
            // dd($value['home_phone']);
            $validate = $individualCon->validateIndividual($value);
            if($validate->fails()){
                return response()->json([
                                        'error' => $validate->messages(),
                                        'error in row' => $line_row 
                                        ], 401);
            }
            $line_row++;
        }
        return self::insertDate($all_data, $individualCon); 
    }
    
    //insert all data in excel file
    protected function insertDate(array $data, object $individualController){
        foreach($data as $key=>$value){
            $individualController->newIndividual($value);
        }
        $response = [
            'msg' => 'Complate file.',
            'all_date' => $data,
        ];
        return response()->json($response, 200);
    }

    public function importIndividuals(Request $request){
        // validate
        
        if(!self::validateExcel($request)){
            return self::getFileData($request->file);
        }
            
        
    }
}
