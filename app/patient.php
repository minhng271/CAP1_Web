<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patient extends Model
{
    
    use SoftDeletes;
    protected $fillable = ['email','password','fullname','id_card','health_card','gender','birthDate','job','phone','address','ward','district','city','country','nation'];
    public function test_patient() 
    {
        return $this->hasMany(test_patient::class, 'id_card', 'id_card');
    }
    
    public function vaccine_patient() 
    {
        return $this->hasMany(vaccine_patient::class, 'id_card', 'id_card');
    }
    
}
