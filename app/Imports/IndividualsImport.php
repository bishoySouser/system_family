<?php

namespace App\Imports;

use App\Individual;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\HttpStatusResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;



class IndividualsImport implements WithValidation, ToCollection, WithHeadingRow, WithEvents
{
    use Importable, RegistersEventListeners;
    private $errors;
    // public static function beforeImport(BeforeImport $event)
    // {
    //     $worksheet = $event->reader->getActiveSheet();
    //     $highestRow = $worksheet->getHighestRow(); // e.g. 10
        
    //     if ($highestRow < 1) {
    //         $error = \Illuminate\Validation\ValidationException::withMessages([]);
    //         $failure = new Failure(1, 'rows', [0 => 'Now enough rows!']);
    //         $failures = [0 => $failure];
    //         dd($failure);
    //         throw new ValidationException($error, $failures);
    //     }
    // }

    public function collection(Collection $rows)
    {   
        
        $rows = $rows->toArray();
            
            foreach($rows as $row){
                $validator = Validator::make($row, $this->rules(), $this->validationMessages());
                if ($validator->fails()) {
                    foreach ($validator->errors()->messages() as $messages) {
                        foreach ($messages as $error) {
                            // accumulating errors:
                            $this->errors[] = $error;
                        }
                    }
                }
               
                // return new Individual([
                //     "first_name" => $row['first_name'],
                //     "middle_name" => $row['middle_name'],
                //     "last_name" => $row['last_name'],
                //     "email" => $row['email'],
                //     "gander" => $row['gender'],
                //     "date_of_birth" => $row['birthday'],
                //     "date_of_death" => $row['death'],
                //     // "age" => $age,
                //     "place_of_birth" => $row['palce_of_birth'],
                //     "area" => $row['area'],
                //     "address" => $row['address'],
                //     "home_phone" => $row['home_phone'],
                //     "mobile_phone1" => $row['mobile1'],
                //     "mobile_phone2" => $row['mobile2'],
                //     "job" => $row['job'],
                //     "is_a_married" => $row['is_a_married']
                // ]);
            }
              
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required'
        ];
    }

    public function validationMessages()
    {
        return [
            
        ];
    }



    // public function validate(array $request) {
    //     $validator = Validator::make($request, [
    //         '*.first_name' => 'required'
    //     ],
    //     [
    //         'required' => "error in row :attribute ."
    //     ]
    // );
        
    //     if($validator->fails()){
    //         throw new HttpResponseException($this->unprocessableEntity( $validator->errors() )); 
    //     }
    //     return false;
    // }
    public function headingRow(): int
    {
        return 1;
    }
    
}
