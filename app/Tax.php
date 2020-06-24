<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = "taxes";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function staff(){
        return $this->belongsTo('App\Staffs');
    }
}
