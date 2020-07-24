<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Individual extends Model
{
    protected $fillable = [
        "id",
        "first_name",
        "middle_name",
        "last_name",
        "gander",
        "date_of_birth",
        "date_of_death",
        "age",
        "place_of_birth",
        "email",
        "area", 
        "address",
        "home_phone",
        "mobile_phone1",
        "mobile_phone2",
        "job",
        "is_a_married",
        "special"
    ];
    public function father(){
        return $this->hasOne('App\Family', 'father_id');
    }
    public function mather(){
        return $this->hasOne('App\Family', 'mather_id');
    }
    public function member(){
        return $this->hasOne('App\FamilyMember', 'individual_id');
    }

    /**
     * @param $dateBirth, $dateBirth
     * @return int $age
     */
    public static function calculateAge($dateDeath = null, $dateBirth)
    {
        if($dateDeath){
            $age = Carbon::parse($dateBirth)->diffInYears($dateDeath);
        }else{
            $age = Carbon::parse($dateBirth)->diffInYears();
        }

        return [
            'age' => $age
        ];
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($individual) { // before delete() method call this
             $individual->member()->delete();
             $individual->father()->delete();
             $individual->mather()->delete();
             // do the rest of the cleanup...
        });
    }
}
