<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //index page controller
    public function index(){
        $title = "Homepage";
        return view('pages.index')->with('title',$title);
    }

    //aboutus page controller
    public function about(){
        $title = "About Us Page";
        return view('pages.about')->with('title',$title);
    }

    //profile page controller
    public function profile(){

        return view('pages.profile')->with($data);
    }
}
