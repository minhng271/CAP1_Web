<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class disease extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','symptom'];
    public function vaccine(){
        return $this->hasMany(vaccine::class,'id_disease','id');
    }
}
