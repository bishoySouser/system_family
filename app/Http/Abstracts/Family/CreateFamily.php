<?php

namespace App\Http\Abstracts\Family;

use App\Family;

class CreateFamily {
    /**
     * @param $request
     * @return bool $family
     */
    public static function insert($request)
    {
        //Create New Family 
        $family = Family::create($request->all());
        return $family;
        
    }
}