<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaccine extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','country','description','age_use_from','age_use_to','id_disease'];

    public function vaccine_patient(){
        return $this->hasMany(vaccine_patient::class,'id_vac','id');
    }

    public function vaccine_hospital(){
        return $this->hasMany(vaccine_hos::class,'id_vac','id');
    }

    public function vaccine(){
        return $this->belongsTo(vaccine::class,'id_disease');
    }
}
