<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vaccine_hos extends Model
{
    use SoftDeletes;
    protected $table = 'vaccine_hos';
    protected $fillable = ['id_vac','id_hos','lot_number','quantity','date_add','date_of_manufacture','out_of_date'];
}
