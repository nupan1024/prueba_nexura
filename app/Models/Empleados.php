<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table = 'empleados';
    public $timestamps = false;

    public function area(){
        return  $this->hasOne('App\Models\Areas','id','area_id');
    }
}
