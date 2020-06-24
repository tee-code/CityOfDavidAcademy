<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $table = "fees";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function classes(){
        return $this->belongsTo('App\Classes');
    }
}
