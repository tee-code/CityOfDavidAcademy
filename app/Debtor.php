<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $table = "debtors";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function student(){
        return $this->belongsTo('App\Student');
    }
}
