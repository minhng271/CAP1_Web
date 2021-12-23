<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class price_disease_hos extends Model
{
    protected $table = 'price_disease_hos';
    protected $fillable = ['id_hos','id_disease','price_vac','price_test'];
    public function disease(){
        return $this->BelongsTo(disease::class);
    }
}
