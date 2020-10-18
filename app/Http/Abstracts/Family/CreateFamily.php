<?php

namespace App\Http\Abstracts\Family;

use App\Family;
use App\Individual;

class CreateFamily {
    /**
     * @param $request
     * @return bool $family
     */
    public static function insert($request)
    {
        //Create New Family 
        $family = Family::create($request->all());
        self::toBeMarriad($family->father_id);
        self::toBeMarriad($family->mather_id);
        return $family;
        
    }

    public static function toBeMarriad($id)
    {
        $persone = Individual::where('id', $id)->update(['is_a_married' => 1]);
    }

    public static function toBeSingle($id)
    {
        $persone = Individual::where('id', $id)->update(['is_a_married' => 0]);
    }
}