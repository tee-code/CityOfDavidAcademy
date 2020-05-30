<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //table name
    public $tabel = "comments";
    //primary key
    public $primaryKey = 'id';
    //timestamp true
    public $timestamp = true;

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
