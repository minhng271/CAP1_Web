<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class test_patient extends Model
{
    use SoftDeletes;
    protected $table = 'test_patient';
    
    public function patient()
    {
        return $this->belongsTo(patient::class, 'id_card');
    }
    public function hospital()
    {
        return $this->belongsTo(hospital::class, 'id_hos');
    }
}
