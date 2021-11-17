<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patient extends Model
{
    
    use SoftDeletes;
    
    public function test_patient() 
    {
        return $this->hasMany(test_patient::class, 'id_card', 'id_card');
    }
    
}
