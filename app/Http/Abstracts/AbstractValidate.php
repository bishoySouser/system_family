<?php
namespace Api\Http\Abstracts;

use Validator;

abstract class AbstractValidate{
    public function validateArgument(array $arr, $rules){
        $validate = Validator::make($arr, $rules);
        return $validate;
    }
}