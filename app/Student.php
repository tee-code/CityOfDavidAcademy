<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function discount(){
        return $this->hasMany('App\Discount');
    }
    public function debtor(){
        return $this->hasMany('App\Debtors');
    }

    public function studentFees(){
        return $this->hasMany('App\StudentFees');
    }

}
