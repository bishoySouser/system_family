<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class Individual extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name" => 'required|string',
            "middle_name" => 'required|string',
            "last_name" => 'required|string',
            "email" => 'nullable|email',
            "gander" => 'required|in:male,female',
            "date_of_birth" => 'required|date|before_or_equal:today',
            "date_of_death" => 'nullable|date|before_or_equal:today',
            "place_of_birth" => 'required|',
            "area" => 'required|string',
            "address" => 'required|string',
            "home_phone" => 'required|regex:/(02)[0-9]{8}/',
            "mobile_phone1" => 'required|regex:/(01)[0-9]{9}/',
            "mobile_phone2" => 'nullable',
            "job" => 'nullable|string',
            "social_status" => 'required|in:single,married',
            "special" => 'nullable|boolean'
        ];
    }
    /** @return array */
    public function messages()
    {
        return [
            'gander.in' => 'The gander must be male or female.',
            'home_phone.regex' => 'The home phone begin -02- then phone number contains 8 number.',
            'mobile_phone1.regex' => 'The Mobile begin -01- then phone number contains 9 number.',
            'social_status.in' => 'The social status must be single or married.'
        ];
    }

    /** @param Validator $validator
     *  @return array $error  */
    protected function failedValidation(Validator $validator) 
    { 
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json([ "errors" =>$validator->errors() ], 422)); 
    
    }
    




    
}
