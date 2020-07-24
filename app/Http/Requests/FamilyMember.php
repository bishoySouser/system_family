<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\HttpStatusResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class FamilyMember extends FormRequest
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
        $family = DB::table('families')->select('family_date_from')->where('id', $this->family_id)->first();
        return [
            "family_id" => ["required", "numeric", "exists:families,id"],
            "individual_id" => ["required", "numeric", "unique:family_members,individual_id",
             'exists:individuals,id', Rule::exists('individuals', 'id')->where(function ($query) use ($family)  {
                $query->where('date_of_birth', '>', $family->family_date_from);
            })]
        ];
    }

    /** @return array */
    public function messages()
    {
        return [
            'family_id.required' => 'The Family is required',
            'family_id,exists'   => 'The selected family is invalid.',
            'individual_id.required' => 'The Family\'s Member is required',
            'individual_id.exists'   => 'The selected Family\'s Member is invalid.',
            'individual_id.unique'   => 'The Family\'s Member has already been taken.'
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
