<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $table = "allowances";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function staff(){
        return $this->belongsTo('App\Staffs');
    }
}
