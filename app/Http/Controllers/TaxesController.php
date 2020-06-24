<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;
use App\Tax;
use App\Staff;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $staffs = Staff::all();
        $taxes = Tax::orderBy('created_at','desc')->paginate(4);

        foreach ($staffs as $staff) {
            $staff->full_name = $staff->first_name . " " . $staff->last_name;
        }

        $staffs = $staffs->pluck('full_name','id');

        foreach ($taxes as $tax) {

            $staff = Staff::find($tax->staff_id);

            $tax->staff_name = $staff->first_name . " " . $staff->last_name;

        }

        $data = [
            "staffs" => $staffs,
            "taxes" => $taxes
        ];

        return view('pages.taxes')->with('data',$data);

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
            "type" => ['required','string','max:255'],
            "staff_id" => ['required','integer'],
            "amount" => ['required','numeric']
        ]);

        $tax = new Tax();
        $tax->type = $request->input('type');
        $tax->staff_id = $request->input('staff_id');
        $tax->amount = $request->input('amount');

        $tax->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $tax->type . " Tax Created";
        $n->table_name = "taxes";

        $n->save();

        return redirect('/dashboard/taxes')->with('success','Tax Added Successfuly');
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
            "type" => ['required','string','max:255'],
            "staff_id" => ['required','integer'],
            "amount" => ['required','numeric']
        ]);

        $tax = Tax::findOrFail($id);
        $tax->type = $request->input('type');
        $tax->staff_id = $request->input('staff_id');
        $tax->amount = $request->input('amount');

        $tax->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $tax->type . " Tax Updated";
        $n->table_name = "taxes";

        $n->save();

        return redirect('/dashboard/taxes')->with('success','Tax Edited Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);

        $tax->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $tax->type . " Tax Deleted";
        $n->table_name = "taxes";

        $n->save();

        return redirect('/dashboard/taxes')->with('success','Tax Deleted Successfully');

    }
}
