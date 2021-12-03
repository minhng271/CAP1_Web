<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaccine_patient extends Model
{
    use SoftDeletes;
    
    public function patient()
    {
        return $this->belongsTo(patient::class, 'id_card');
    }
    
    public function hospital()
    {
        return $this->belongsTo(patient::class, 'id_hos');
    }
    
    public function vaccine()
    {
        return $this->belongsTo(vaccine::class, 'id_vac');
    }
}
