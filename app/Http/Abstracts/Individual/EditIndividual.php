<?php

namespace App\Http\Abstracts\Individual;
use App\Individual;
use App\Family;
use App\FamilyMember;
use DB;


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

        // Check request has famil_id 
        if($request->family_id)
        {
            // check if family id is exist
            $family = Family::find($request->family_id);
            if ($family)
            {
                $full_name = DB::table('individuals')
                                ->select("first_name AS M_name", "middle_name AS L_name")
                                ->where("id", $family->father_id)
                                ->get();
                
                // Change middle and last name in this individual
                $request->merge([
                    'middle_name' => $full_name[0]->M_name,
                    'last_name' => $full_name[0]->L_name,
                ]);
                
                // Add indivdiaul to family he be member to family
                // dd($family->father_id);
                $new_member = FamilyMember::create([
                    'family_id' => $family->id,
                    'individual_id' => $id
                ]);
            }
            
        }

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