<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaccine_hos extends Model
{
    use SoftDeletes;
    protected $table = 'vaccine_hos';

}
