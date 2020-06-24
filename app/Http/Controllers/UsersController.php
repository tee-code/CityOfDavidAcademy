<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $users = User::orderBy('created_at','asc')->paginate(5);
        return view('pages.users')->with('users',$users);
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
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = "Admin";
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $user->name . " Admin Profile Created";
        $n->table_name = "users";

        $n->save();

        return redirect('/dashboard/users')->with('success', 'New User Added');

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::findorFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $user->name . " Admin Profile Updated";
        $n->table_name = "users";

        $n->save();

        return redirect('/dashboard/users')->with('success','User Info Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(auth()->user()->role !== "Super Admin"){
            return redirect('/dashboard/users')->with('error','Unauthorized Action');
        }

        $user->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $user->name . " Admin Profile Deleted";
        $n->table_name = "users";

        $n->save();

        return redirect('/dashboard/users')->with('success','User Deleted Successfully');
    }
}
