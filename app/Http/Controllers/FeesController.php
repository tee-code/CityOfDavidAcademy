<?php

namespace App\Http\Controllers;

use App\Fees;
use App\Classes;
use App\Notification;

use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fees::orderBy('created_at','asc')->paginate(5);

        $classes = Classes::all();

        $cls = $classes->pluck('classes','id');

        $data = [
            "fees" => $fees,
            "cls" => $cls
        ];


        return view('pages.fees')->with('data',$data);
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
            "feesType" => ['required', 'string', 'max:255'],
            "feesAmount" => ['required', 'numeric'],
            "class_id" => ['required','integer','max:10']
        ]);

        $fee = new Fees();
        $fee->feesType = $request->input('feesType');
        $fee->feesAmount = $request->input('feesAmount');
        $fee->classes_id = $request->input('class_id');

        $fee->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $fee->feesType . " Fee Created";
        $n->table_name = "fees";

        $n->save();
        return redirect('/dashboard/fees')->with('success','Fee Successfully Added');

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
            "feesType" => ['required', 'string', 'max:255'],
            "feesAmount" => ['required', 'numeric'],
            "class_id" => ['required','integer','max:10']
        ]);

        $fee = Fees::findOrFail($id);

        $fee->feesType = $request->input('feesType');
        $fee->feesAmount = $request->input('feesAmount');
        $fee->classes_id = $request->input('class_id');

        $fee->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $fee->feesType . " Fee Updated";
        $n->table_name = "fees";

        $n->save();

        return redirect('/dashboard/fees')->with('success','Fee Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee = Fees::findorFail($id);

        $fee->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $fee->feesType . " Fee Deleted";
        $n->table_name = "fees";

        $n->save();

        return redirect('/dashboard/fees')->with('success','Fee Deleted Successfully');
    }
}
