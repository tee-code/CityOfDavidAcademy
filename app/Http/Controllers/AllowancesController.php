<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Allowance;
use App\Notification;
use App\Staff;

class AllowancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::all();
        $allowances = Allowance::orderBy('created_at','desc')->paginate(4);

        foreach ($staffs as $staff) {
            $staff->full_name = $staff->first_name . " " . $staff->last_name;
        }

        $staffs = $staffs->pluck('full_name','id');

        foreach ($allowances as $allowance) {

            $staff = Staff::find($allowance->staff_id);

            $allowance->staff_name = $staff->first_name . " " . $staff->last_name;

        }

        $data = [
            "staffs" => $staffs,
            "allowances" => $allowances
        ];

        return view('pages.allowances')->with('data',$data);

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

        $allowance = new Allowance();
        $allowance->type = $request->input('type');
        $allowance->staff_id = $request->input('staff_id');
        $allowance->amount = $request->input('amount');

        $allowance->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $allowance->type . " Allowance Created";
        $n->table_name = "allowances";

        $n->save();

        return redirect('/dashboard/allowances')->with('success','Allowance Added Successfuly');
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

        $allowance = Allowance::findOrFail($id);
        $allowance->type = $request->input('type');
        $allowance->staff_id = $request->input('staff_id');
        $allowance->amount = $request->input('amount');

        $allowance->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $allowance->type . " Allowance Updated";
        $n->table_name = "allowances";

        $n->save();

        return redirect('/dashboard/allowances')->with('success','Allowance Edited Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allowance = Allowance::findOrFail($id);

        $allowance->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $allowance->type . " Allowance Deleted";
        $n->table_name = "allowances";

        $n->save();

        return redirect('/dashboard/allowances')->with('success','Allowance Deleted Successfully');

    }
}
