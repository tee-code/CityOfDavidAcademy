<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
            'password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        if(auth()->user()->id != $id){
            return redirect('/dashboard/profile/'.$id)->with('error','Unauthorized Action');
        }

        if(!Hash::check($request->input('password'), auth()->user()->password)){
            return redirect('/dashboard/profile/'.$id)->with('error','Current Password Incorrect');
        }

        $user = User::findOrFail($id);

        $user->password = Hash::make($request->input('password'));

        $user->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $user->name . " Password Updated";
        $n->table_name = "users";

        $n->save();

        return redirect('/dashboard/profile/'.$id)->with('success','Password Updated Successfully');



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
