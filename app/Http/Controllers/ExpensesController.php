<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Expenses;


use Illuminate\Http\Request;

class ExpensesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expenses::orderBy('created_at','asc')->paginate(5);

        return view('pages.expenses')->with('expenses',$expenses);
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
            "type" => ['required', 'string', 'max:255','unique:expenses'],
            "amount" => ['required', 'numeric'],
            "description" => ['required', 'string','max:255'],
            "amount" => ['required', 'numeric'],
        ]);

        $expense = new Expenses();
        $expense->type = $request->input('type');
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');

        $expense->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $expense->type . " Expenses Created";
        $n->table_name = "expenses";

        $n->save();
        return redirect('/dashboard/expenses')->with('success','Expenses Successfully Added');

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
            "type" => ['required', 'string', 'max:255'],
            "amount" => ['required', 'numeric'],
            "description" => ['required', 'string','max:255'],
            "amount" => ['required', 'numeric'],
        ]);

        $expense = Expenses::findOrFail($id);
        $expense->type = $request->input('type');
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');

        $expense->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $expense->type . " Expenses Updated";
        $n->table_name = "expenses";

        $n->save();

        return redirect('/dashboard/expenses')->with('success','Expenses Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expenses::findorFail($id);

        $expense->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $expense->type . " Expenses Deleted";
        $n->table_name = "expenses";

        $n->save();

        return redirect('/dashboard/expenses')->with('success','Expenses Deleted Successfully');
    }
}
