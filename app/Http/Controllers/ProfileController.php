<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Notification;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user_id = auth()->user()->id;
        $user = User::find($id);
        return view('pages.profile')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);



        if(auth()->user()->id != $id){
            return redirect('/dashboard/profile/'.$id)->with('error','Unauthorized Action');
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $user->name . " Profile Updated";
        $n->table_name = "users";

        $n->save();

        return redirect('/dashboard/profile/'.$id)->with('success','Profile Successfully Updated');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
