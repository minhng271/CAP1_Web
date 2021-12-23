<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use users;

class hospital extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','address','phone','id_user','city','province','ward','created_at','updated_at'];
    public function test_patient()
    {
        return $this->hasMany(test_patient::class, 'id_hos', 'id');
    }
    public function vaccine_hos()
    {
        return $this->hasMany(vaccine_hos::class, 'id_hos', 'id');
    }
    public function vaccine_patient()
    {
        return $this->hasMany(vaccine_patient::class, 'id_hos', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
