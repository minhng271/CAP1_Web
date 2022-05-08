<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class limit_update extends Model
{
    
    protected $fillable = ['date','id_hos', 'limit_test', 'limit_vaccine'];
    
}
