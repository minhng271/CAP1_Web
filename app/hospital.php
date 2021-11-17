<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hospital extends Model
{
    use SoftDeletes;

    public function test_patient()
    {
        return $this->hasMany(test_patient::class, 'id_hos', 'id');
    }
}
