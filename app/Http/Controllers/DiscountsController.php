<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\Discount;
use App\Section;
use App\Classes;
use App\Notification;
use App\Fees;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('created_at','desc')->paginate(4);

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

        foreach ($discounts as $discount) {

            $student = Student::findOrFail($discount->student_id);
            $classes = Classes::find($discount->classes_id);
            $fee = Fees::findOrFail($discount->fees_id);
            $section = Section::findOrFail($discount->section_id);

            $discount->student_name = $student->first_name . ' ' . $student->last_name;
            $discount->section = $section->section;
            $discount->feeType = $fee->feesType;
            $discount->classes = $classes->classes;

        }

        $data = [
            "fees" => $fees,
            "sections" => $sections,
            "students" => $students,
            "discounts" => $discounts,
            "classes" => $classes
        ];

        return view('pages.discounts')->with('data',$data);
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
            'section_id' => ['required','integer'],
            'student_id' => ['required','integer'],
            'fees_id' => ['required','integer'],
            'amount' => ['required','numeric'],
        ]);

        $discount = new Discount();
        $discount->term = $request->input('term');
        $discount->fees_id = $request->input('fees_id');
        $discount->student_id = $request->input('student_id');
        $discount->section_id = $request->input('section_id');

        $fees = Fees::find($discount->fees_id);
        $discount->classes_id = $fees->classes_id;
        $discount->amount = $request->input('amount');

        $discount->save();

        $discount_for = Student::findOrFail($discount->student_id);
        $discount_fee = Fees::findOrFail($discount->fees_id);
        $discount_section = Section::findOrFail($discount->section_id);

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = $discount_for->first_name . " is given a discount on " . $discount_fee->feesType . " for " . $discount_section->section . " section";
        $n->table_name = "discounts";

        $n->save();

        return redirect('/dashboard/discounts')->with('success','Discount Added Successfuly');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
            'section_id' => ['required','integer'],
            'student_id' => ['required','integer'],
            'fees_id' => ['required','integer'],
            'amount' => ['required','numeric'],
        ]);

        $discount = Discount::findOrFail($id);
        $discount->term = $request->input('term');
        $discount->fees_id = $request->input('fees_id');
        $discount->student_id = $request->input('student_id');
        $discount->section_id = $request->input('section_id');
        $fees = Fees::find($discount->fees_id);
        $discount->classes_id = $fees->classes_id;
        $discount->amount = $request->input('amount');

        $discount->save();

        $discount_for = Student::findOrFail($discount->student_id);

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = $discount_for->first_name . " discount updated";
        $n->table_name = "discounts";

        $n->save();

        return redirect('/dashboard/discounts')->with('success','Discount Edited Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        $discount->delete();

        $discount_for = Student::findOrFail($discount->student_id);

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = $discount_for->first_name . " discount information deleted";
        $n->table_name = "discounts";

        $n->save();

        return redirect('/dashboard/discounts')->with('success','Discount Deleted Successfuly');
    }
}
