<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        "place_of_birth",
        "email",
        "area", 
        "address",
        "home_phone",
        "mobile_phone1",
        "mobile_phone2",
        "job",
        "social_status",
        "special"
    ];
}
