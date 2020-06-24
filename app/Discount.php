<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = "discounts";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function student(){
        return $this->belongsTo('App\Student');
    }
}
