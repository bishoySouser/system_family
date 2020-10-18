<?php

namespace App\Http\Abstracts\Individual;

use App\Individual;
use DB;

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
        if($request->family_id){
            DB::table("family_members")->insert([
                'family_id' => $request->family_id,
                'individual_id' => $persone->id
            ]);
        }
        if($persone->save()){
            return $persone;
        }
    }
    
}


