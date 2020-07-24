<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'family_id',
        'individual_id'
    ];
    public function person(){
        return $this->belongsTo('App\Individual', 'id');
    }
}
