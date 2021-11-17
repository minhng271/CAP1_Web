<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaccine extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','country','description','age_use_from','age_use_to'];

}
