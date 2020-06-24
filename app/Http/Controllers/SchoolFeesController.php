<?php

namespace App\Http\Controllers;

use App\StudentFees;
use App\Student;
use App\Section;
use App\Classes;
use App\Fees;
use App\Notification;
use Illuminate\Http\Request;


class SchoolFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $student_fees = StudentFees::orderBy('created_at','desc')->paginate(5);

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


        foreach ($student_fees as $student_fee) {

            $student = Student::findOrFail($student_fee->student_id);
            $cls = Classes::findOrFail($student_fee->classes_id);
            $section = Section::findOrFail($student_fee->section_id);
            $fee = Fees::findOrFail($student_fee->fees_id);


            $student_fee->student_name = $student->first_name . ' ' . $student->last_name;
            $student_fee->section = $section->section;
            $student_fee->classes = $cls->classes;
            $student_fee->feeType = $fee->feesType;
        }


        $data = [
            "fees" => $fees,
            "sections" => $sections,
            "students" => $students,
            "schoolfees" => $student_fees,
            "classes" => $classes
        ];

        return view('pages.schoolfees')->with('data',$data);
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
            'payment_method' => ['required','string','max:255'],
            'section_id' => ['required','integer'],
            'student_id' => ['required','integer'],
            'fees_id' => ['required','integer'],
            'amount' => ['required','numeric'],
        ]);

        $student_fee = new StudentFees();
        $student_fee->term = $request->input('term');
        $student_fee->payment_method = $request->input('payment_method');
        $student_fee->fees_id = $request->input('fees_id');
        $student_fee->student_id = $request->input('student_id');
        $student_fee->section_id = $request->input('section_id');
        $student_fee->classes_id = $request->input('classes_id');
        $student_fee->amount = $request->input('amount');

        $fees = Fees::find($student_fee->fees_id);
        $student_fee->classes_id = $fees->classes_id;


        $student_fee->save();

        $student = Student::findOrFail($student_fee->student_id);

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = "Created New School Fees Payment: " . $student->first_name . " " . $student->last_name;
        $n->table_name = "studentfees";

        $n->save();

        return redirect('/dashboard/schoolfees')->with('success', 'New Payment Added');

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
            'payment_method' => ['required','string','max:255'],
            'section_id' => ['required','integer'],
            'student_id' => ['required','integer'],
            'fees_id' => ['required','integer'],
            'amount' => ['required','numeric'],
        ]);

        $student_fee = StudentFees::findOrFail($id);
        $student_fee->term = $request->input('term');
        $student_fee->payment_method = $request->input('payment_method');
        $student_fee->fees_id = $request->input('fees_id');
        $student_fee->student_id = $request->input('student_id');
        $student_fee->section_id = $request->input('section_id');
        $student_fee->classes_id = $request->input('classes_id');
        $student_fee->amount = $request->input('amount');

        $fees = Fees::find($student_fee->fees_id);
        $student_fee->classes_id = $fees->classes_id;


        $student_fee->save();

        $student = Student::findOrFail($student_fee->student_id);

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = "Updated School Fees Payment: " . $student->first_name . " " . $student->last_name;
        $n->table_name = "studentfees";

        $n->save();

        return redirect('/dashboard/schoolfees')->with('success', 'School Fees Payment Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_fee = StudentFees::findorFail($id);

        $student_fee->delete();

        $student = Student::findOrFail($student_fee->student_id);

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = "StudentFees Information Deleted: " . $student->first_name . " " . $student->last_name;
        $n->table_name = "studentfees";

        $n->save();

        return redirect('/dashboard/schoolfees')->with('success','StudentFees Deleted Successfully');
    }
}
