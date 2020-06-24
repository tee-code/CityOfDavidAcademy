<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //Table Name
    protected $table = 'expenses';
    //Primary keyphp artisan migrate applicationphp artisan migrate application
    public $primaryKey = 'id';
    //Timestamps
    public $timestamp = true;
}
