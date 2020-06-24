<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Debtor;
use App\Notification;
use App\Student;
use App\Section;
use App\Classes;
use App\Fees;

class DebtorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtors = Debtor::orderBy('created_at','desc')->paginate(4);

        $sections = Section::all();
        $fees = Fees::all();
        $classes = Classes::all();

        $students = Student::all();

        foreach ($students as $student) {
            $student->full_name = $student->first_name . " " . $student->last_name;
        }

        $sections = $sections->pluck('section','id');
        $classes = $classes->pluck('classes','id');
        $students = $students->pluck('full_name','id');

        foreach ($fees as $fee) {
            $fee->feesType = $classes["$fee->classes_id"] . ": $fee->feesType";
        }

        $fees = $fees->pluck('feesType','id');

        foreach ($debtors as $debtor) {

            $student = Student::findOrFail($debtor->student_id);
            $classes = Classes::find($debtor->classes_id);
            $fee = Fees::findOrFail($debtor->fees_id);
            $section = Section::findOrFail($debtor->section_id);

            $debtor->student_name = $student->first_name . ' ' . $student->last_name;
            $debtor->section = $section->section;
            $debtor->feeType = $fee->feesType;
            $debtor->classes = $classes->classes;

        }

        $data = [
            "fees" => $fees,
            "sections" => $sections,
            "students" => $students,
            "debtors" => $debtors,
            "classes" => $classes
        ];

        return view('pages.debtors')->with('data',$data);

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
            'term' => ['required','string','max:255'],
            'student_id' => ['required','integer'],
            'section_id' => ['required','integer'],

            'fees_id' => ['required','integer'],
            'amount' => ['required','numeric']
        ]);

        $debtor = new Debtor();
        $debtor->term = $request->input('term');
        $debtor->student_id = $request->input('student_id');
        $debtor->section_id = $request->input('section_id');

        $debtor->fees_id = $request->input('fees_id');
        $debtor->amount = $request->input('amount');

        $fees = Fees::find($debtor->fees_id);
        $debtor->classes_id = $fees->classes_id;

        $debtor->save();

        $debtor_name = Student::findOrFail($debtor->student_id);

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $debtor_name->first_name . " is added as debtor";
        $n->table_name = "debtors";

        $n->save();

        return redirect('/dashboard/debtors')->with('success','Debtor Added Successfuly');
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
            'term' => ['required','string','max:255'],
            'student_id' => ['required','integer'],
            'section_id' => ['required','integer'],
            'fees_id' => ['required','integer'],
            'amount' => ['required','numeric']
        ]);

        $debtor = Debtor::findOrFail($id);
        $debtor->term = $request->input('term');
        $debtor->student_id = $request->input('student_id');
        $debtor->section_id = $request->input('section_id');

        $debtor->fees_id = $request->input('fees_id');
        $debtor->amount = $request->input('amount');

        $fees = Fees::find($debtor->fees_id);
        $debtor->classes_id = $fees->classes_id;


        $debtor->save();

        $debtor_name = Student::findOrFail($debtor->student_id);

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $debtor_name->first_name . "'s debt is updated";
        $n->table_name = "debtors";

        $n->save();

        return redirect('/dashboard/debtors')->with('success','Debtor Edited Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $debtor = Debtor::findOrFail($id);

        $debtor->delete();

        $debtor_name = Student::findOrFail($debtor->student_id);

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $debtor_name->first_name . "'debt deleted";
        $n->table_name = "debtors";

        $n->save();

        return redirect('/dashboard/debtors')->with('success','Debtor Deleted Successfuly');
    }
}
