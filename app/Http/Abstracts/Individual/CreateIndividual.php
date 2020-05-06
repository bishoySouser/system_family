<?php

namespace App\Http\Abstracts\Individual;

use Illuminate\Http\Request;
use App\Individual;
use Carbon\Carbon;

class CreateIndividual {
    /**
     * @param Request $request
     * @return response
     */
    public static function insert($request){
        //merge age
        $age = array( 'age' => self::calculateAge($request->date_of_death, $request->date_of_birth));
        $request->merge($age);
        $persone = Individual::create($request->all());
        if($persone->save()){
            return $persone;
        }
    }
    /**
     * @param $dateBirth, $dateBirth
     * @return $age
     */
    private static function calculateAge($dateDeath = null, $dateBirth)
    {
        if($dateDeath){
            $age = Carbon::parse($dateBirth)->diffInYears($dateDeath);
        }else{
            $age = Carbon::parse($dateBirth)->diffInYears();
        }
        return $age;
    }
    
    protected static function mergeToRequest(Request $request, array $array)
    {
        $request->merge($array);
        return $request;
    }
}


