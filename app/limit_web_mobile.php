<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class limit_web_mobile extends Model
{
    protected $table = 'limit_web_mobile';
    protected $fillable = ['id_hos','limit_test','limit_vac'];
}
