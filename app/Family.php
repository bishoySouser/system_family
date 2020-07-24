<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'father_id',
        'mather_id',
        'family_date_from',
    ];
    public function father(){
        return $this->belongsTo('App\Individual', 'father_id');
    }
    public function mather(){
        return $this->belongsTo('App\Individual', 'mather_id');
    }
    public function member(){
        return $this->hasOne('App\FamilyMember', 'family_id');
    }
}
