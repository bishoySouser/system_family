<?php

namespace App\Http\Abstracts\Family;

use App\Family;

class EditFamily {
    /**
     * @param $request
     * @return bool $family
     */
    public static function update($request, $id)
    {
        $family = false;
        Family::chunk(200, function ($rows) use ($id, $request, &$family) {
            foreach ($rows as $row) {
                if($row->id == $id){
                    $family =  $row->update($request->all());;
                    return false;
                }
               
            }
        });
        return $family;
        
    }
}