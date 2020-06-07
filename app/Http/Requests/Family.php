<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\HttpStatusResponse;
use Illuminate\Validation\Rule;

class Family extends FormRequest
{
    use HttpStatusResponse;
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
            "father_id" => ["required", "numeric", "unique:families,father_id,{$this->father_id},father_id", Rule::exists('individuals', 'id')->where(function ($query) {
                $query->where('gander', 'male');
            })],
            "mather_id" => ["required", "numeric", "unique:families,mather_id,{$this->mather_id},mather_id", Rule::exists('individuals', 'id')->where(function ($query) {
                $query->where('gander', 'female');
            })],
            "family_date_from" => "nullable|date|before_or_equal:today"
        ];
    }

    /** @return array */
    public function messages()
    {
        return [
            'father_id' => 'The father field is required',
            'mather_id' => 'The mather field is required',
            'father_id.exists' => 'The father must be male',
            'mather_id.exists' => 'The mather must be female'
            
        ];
    }

    

    /** @param Validator $validator
     *  @return array $error  */
    protected function failedValidation(Validator $validator) 
    { 
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException($this->unprocessableEntity( $validator->errors() )); 
        
    
    } 
}
