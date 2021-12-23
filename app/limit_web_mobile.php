<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class limit_web_mobile extends Model
{
    protected $table = 'limit_update';
    protected $fillable = ['date','id_hos', 'limit_test', 'limit_vaccine'];
}
