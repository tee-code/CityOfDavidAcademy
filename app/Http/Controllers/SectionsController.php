<?php

namespace App\Http\Controllers;

use App\Section;
use App\Notification;
use Illuminate\Http\Request;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $sections = Section::orderBy('created_at','asc')->paginate(5);
        return view('pages.sections')->with('sections',$sections);
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
            'section' => ['required', 'string', 'max:255','unique:sections']
        ]);

        $section = new Section;
        $section->section = $request->input('section');


        $section->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $section->section . " Section Created";
        $n->table_name = "sections";

        $n->save();

        return redirect('/dashboard/sections')->with('success', 'New Section Added');

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
            'section' => ['required', 'string', 'max:255']
        ]);

        $section = Section::findorFail($id);

        $section->section = $request->input('section');


        $section->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $section->section . " Section Updated";
        $n->table_name = "sections";

        $n->save();

        return redirect('/dashboard/sections')->with('success','Section Info Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::findorFail($id);

        $section->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $section->section . " Section Deleted";
        $n->table_name = "sections";

        $n->save();

        return redirect('/dashboard/sections')->with('success','Section Deleted Successfully');
    }
}
