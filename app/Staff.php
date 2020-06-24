<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = "staffs";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function tax(){
        return $this->hasMany('App\Tax');
    }
    public function allowance(){
        return $this->hasMany('App\Allowance');
    }
}
