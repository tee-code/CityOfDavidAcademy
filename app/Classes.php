<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //Table Name
    protected $table = 'classes';
    //Primary keyphp artisan migrate applicationphp artisan migrate application
    public $primaryKey = 'id';
    //Timestamps
    public $timestamp = true;

    public function fees(){
        return $this->hasMany('App\Fees');
    }
}
