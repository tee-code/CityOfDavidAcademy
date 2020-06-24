<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $n = Notification::orderBy('created_at','desc')->paginate(3);

        return view('pages.notification')->with('notifications',$n);
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
            "type" => ['required', 'string', 'max:255'],
            "message" => ['required', 'string', 'max:255'],
            "table_name" => ['required', 'string', 'max:255'],
            "user_id" => ['required','integer','max:10']
        ]);

        $n = new Notification();
        $n->type = $request->input('type');
        $n->message = $request->input('message');
        $n->user_id = $request->input('user_id');
        $n->table_name = $request->input('table_name');

        $n->save();

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
     * Show the form for editing the specified resource     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $n = Notification::findorFail($id);

        $n->delete();

        return redirect('/dashboard/notifications')->with('success','Action Deleted Successfully');
    }
}
