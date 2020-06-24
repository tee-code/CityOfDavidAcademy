<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFees extends Model
{
    protected $table = "student_fees";
    public $primaryKey = 'id';
    public $timestamp = true;


    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function section(){
        return $this->belongsTo('App\Section');
    }

    public function fees(){
        return $this->belongsTo('App\Fees');
    }

    public function classes(){
        return $this->belongsTo('App\Classes');
    }


}
