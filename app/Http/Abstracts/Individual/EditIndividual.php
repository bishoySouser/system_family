<?php

namespace App\Http\Abstracts\Individual;
use App\Individual;


class EditIndividual {

    /**
     * @param Request $request
     * @return $persone
     */
    public static function update($request, $id){
        //Get Age
        $age = Individual::calculateAge($request->date_of_death, $request->date_of_birth);

        //Merge Age to $request
        $request->merge($age);
        $persone = false;
        //Update Individual => ID
        // $persone = Individual::where('id', $id)
        //                     ->update($request->all());
        Individual::chunk(200, function ($individuals) use ($id, $request, &$persone) {
            foreach ($individuals as $individual) {
                if($individual->id == $id){
                    $persone =  $individual->update($request->all());;
                    return false;
                }
               
            }
        });
        return $persone;
    }
}