<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hospital extends Model
{

    function user(){
        return $this->belongsTo('App/User');
    }
}
