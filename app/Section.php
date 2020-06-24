<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //Table Name
    protected $table = 'sections';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamp = true;
}
