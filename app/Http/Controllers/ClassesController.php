<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Notification;
use Illuminate\Http\Request;


class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $classes = Classes::orderBy('created_at','asc')->paginate(5);
        return view('pages.classes')->with('classes',$classes);
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
            'classes' => ['required', 'string', 'max:255','unique:classes']
        ]);

        $classes = new Classes;
        $classes->classes = $request->input('classes');

        $classes->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $classes->classes . " Class Created";
        $n->table_name = "classes";

        $n->save();

        return redirect('/dashboard/classes')->with('success', 'New Classes Added');

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
            'classes' => ['required', 'string', 'max:255']
        ]);

        $classes = Classes::findorFail($id);

        $classes->classes = $request->input('classes');


        $classes->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $classes->classes . " Class Updated";
        $n->table_name = "classes";

        $n->save();

        return redirect('/dashboard/classes')->with('success','Class Info Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classes = Classes::findorFail($id);

        $classes->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $classes->classes . " Classes Deleted";
        $n->table_name = "classes";

        $n->save();

        return redirect('/dashboard/classes')->with('success','Class Deleted Successfully');
    }
}
