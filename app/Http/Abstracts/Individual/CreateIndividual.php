<?php

namespace App\Http\Abstracts\Individual;

use App\Individual;

class CreateIndividual {
    /**
     * @param Request $request
     * @return $persone
     */
    public static function insert($request){
        //Get Age
        $age = Individual::calculateAge($request->date_of_death, $request->date_of_birth);

        //Merge Age to $request
        $request->merge($age);

        //Create New Individual 
        $persone = Individual::create($request->all());
        if($persone->save()){
            return $persone;
        }
    }
    
}


