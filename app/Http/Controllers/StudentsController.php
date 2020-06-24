<?php

namespace App\Http\Controllers;

use App\Student;
use App\Section;
use App\Classes;
use App\Notification;
use App\Discount;
use App\Debtor;
use App\Fees;
use App\StudentFees;
use Illuminate\Http\Request;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {

        $students = Student::orderBy('first_name','asc')->paginate(5);
        $sections = Section::all();
        $classes = Classes::all();

        $classes = $classes->pluck('classes','id');
        $sections = $sections->pluck('section','id');


        foreach ($students as $student) {

            $now = date('Y');
            $dob = date_format(date_create($student->dob),'Y');

            $age = $now - $dob;

            $student->age = $age;
            $student->full_name = $student->first_name . " " . $student->last_name;
            $student->current_class = Classes::findOrFail($student->current_class_id)->classes;
            $student->class_joined = Classes::findOrFail($student->class_joined_id)->classes;
            $student->section_joined = Section::findOrFail($student->section_joined_id)->section;


            if(Discount::where("student_id","=",$student->id)->exists()){

                $student->discount_status = "True";
            }else{
                $student->discount_status = "False";
            }

            if(Debtor::where("student_id","=",$student->id)->exists()){
                $debits = Debtor::where("student_id","=",$student->id)->get();
                $student->debit = 0.00;

                foreach ($debits as $debit) {
                    $student->debit += $debit->amount;
                }

            }else{
                $student->debit = 0.00;
            }

            if(StudentFees::where("student_id","=",$student->id)->exists()){
                $schoolfees = StudentFees::where("student_id","=",$student->id)->get();


                $studentfees = [];

                foreach ($schoolfees as $schoolfee) {
                    $fees = Fees::where("id","=",$schoolfee->fees_id)->get();
                    $cls = Classes::findOrFail($schoolfee->classes_id);
                    $section = Section::findOrFail($schoolfee->section_id);

                    foreach ($fees as $fee) {
                        $balance = $fee->feesAmount - $schoolfee->amount;
                        array_push($studentfees,"$fee->feesType : $fee->feesAmount<br/> Paid: $schoolfee->amount <br/> Balance: $balance <br/> Class: $cls->classes <br/? Term: $schoolfee->term <br /> Session: $section->section <br/>");
                    }

                    $student->schoolfee = $studentfees;

                }

            }else{
                $student->debit = 0.00;
            }


        }




        $data = [
            "students" => $students,
            "sections" => $sections,
            "classes" => $classes
        ];

        return view('pages.students')->with('data',$data);
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
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15','unique:students'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'term_joined' => ['required', 'string','max:255'],
            'current_class_id' => ['required', 'integer'],
            'class_joined_id' => ['required', 'integer'],
            'section_joined_id' => ['required', 'integer'],
        ]);

        $student = new Student;
        $student->address = $request->input('address');
        $student->phone_number = $request->input('phone_number');
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->dob = $request->input('dob');
        $student->term_joined = $request->input('term_joined');
        $student->current_class_id = $request->input('current_class_id');
        $student->class_joined_id = $request->input('class_joined_id');
        $student->section_joined_id = $request->input('section_joined_id');


        $student->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = "Created New Student: " . $student->first_name . " " . $student->last_name;
        $n->table_name = "students";

        $n->save();

        return redirect('/dashboard/students')->with('success', 'New Student Added');

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
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'term_joined' => ['required', 'string','max:255'],
            'current_class_id' => ['required', 'integer'],
            'class_joined_id' => ['required', 'integer'],
            'section_joined_id' => ['required', 'integer'],
        ]);

        $student = Student::findOrFail($id);
        $student->address = $request->input('address');
        $student->phone_number = $request->input('phone_number');
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->dob = $request->input('dob');
        $student->term_joined = $request->input('term_joined');
        $student->current_class_id = $request->input('current_class_id');
        $student->class_joined_id = $request->input('class_joined_id');
        $student->section_joined_id = $request->input('section_joined_id');


        $student->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = "Updated Student: " . $student->first_name . " " . $student->last_name;
        $n->table_name = "students";

        $n->save();

        return redirect('/dashboard/students')->with('success', 'Student Info Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findorFail($id);

        $student->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = "Deleted Student: " . $student->first_name . " " . $student->last_name;
        $n->table_name = "students";

        $n->save();

        return redirect('/dashboard/students')->with('success','Student Deleted Successfully');
    }
}
