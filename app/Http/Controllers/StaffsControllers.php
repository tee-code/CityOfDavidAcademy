<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Notification;
use App\Section;
use App\Allowance;
use App\Tax;

use Illuminate\Http\Request;


class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $staffs = Staff::orderBy('created_at','asc')->paginate(5);
        $sections = Section::all();

        $sections = $sections->pluck('section','id');

        foreach ($staffs as $staff) {

            $now = date('Y');
            $dob = date_format(date_create($staff->dob),'Y');

            $age = $now - $dob;

            $staff->age = $age;
            $staff->full_name = $staff->first_name . " " . $staff->last_name;
            $staff->section_joined = Section::findOrFail($staff->section_joined_id)->section;

            if(Tax::where("staff_id","=",$staff->id)->exists()){
                $taxes = Tax::where("staff_id","=",$staff->id)->get();
                $staff->tax = 0.00;

                foreach ($taxes as $tax) {
                    $staff->tax += $tax->amount;
                }

            }else{
                $staff->tax = 0.00;
            }

            if(Allowance::where("staff_id","=",$staff->id)->exists()){
                $allowances = Allowance::where("staff_id","=",$staff->id)->get();
                $staff->allowance = 0.00;

                foreach ($allowances as $allowance) {
                    $staff->allowance += $allowance->amount;
                }

            }else{
                $staff->allowance = 0.00;
            }

            $staff->total = $staff->basic_salary + $staff->allowance - $staff->tax;

        }

        $data = [
            "staffs" => $staffs,
            "sections" => $sections,
        ];

        return view('pages.staffs')->with('data',$data);
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
            'email' => ['required', 'string', 'max:255','unique:staffs'],
            'phone_number' => ['required', 'string', 'max:15'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'basic_salary' => ['required', 'numeric'],
            'term_joined' => ['required', 'string','max:255'],
            'section_joined_id' => ['required', 'integer'],
        ]);

        $staff = new Staff;
        $staff->email = $request->input('email');
        $staff->phone_number = $request->input('phone_number');
        $staff->first_name = $request->input('first_name');
        $staff->last_name = $request->input('last_name');
        $staff->basic_salary = $request->input('basic_salary');
        $staff->address = $request->input('address');
        $staff->dob = $request->input('dob');
        $staff->term_joined = $request->input('term_joined');
        $staff->section_joined_id = $request->input('section_joined_id');


        $staff->save();

        $n = new Notification();
        $n->type = "CREATE";
        $n->user_id = auth()->user()->id;
        $n->message = "Created New Staff: " . $staff->first_name . " " . $staff->last_name;
        $n->table_name = "staffs";

        $n->save();

        return redirect('/dashboard/staffs')->with('success', 'New Staff Added');

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
            'email' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'basic_salary' => ['required', 'numeric'],
            'dob' => ['required', 'date'],
            'term_joined' => ['required', 'string','max:255'],
            'section_joined_id' => ['required', 'integer'],
        ]);

        $staff = Staff::findOrFail($id);
        $staff->email = $request->input('email');
        $staff->phone_number = $request->input('phone_number');
        $staff->first_name = $request->input('first_name');
        $staff->last_name = $request->input('last_name');
        $staff->basic_salary = $request->input('basic_salary');
        $staff->address = $request->input('address');
        $staff->dob = $request->input('dob');
        $staff->term_joined = $request->input('term_joined');
        $staff->section_joined_id = $request->input('section_joined_id');


        $staff->save();

        $n = new Notification();
        $n->type = "UPDATE";
        $n->user_id = auth()->user()->id;
        $n->message = "Updated Staff: " . $staff->first_name . " " . $staff->last_name;
        $n->table_name = "staffs";

        $n->save();

        return redirect('/dashboard/staffs')->with('success', 'Staff Info Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::findorFail($id);

        $staff->delete();

        $n = new Notification();
        $n->type = "DELETE";
        $n->user_id = auth()->user()->id;
        $n->message = "Deleted Staff: " . $staff->first_name . " " . $staff->last_name;
        $n->table_name = "staffs";

        $n->save();

        return redirect('/dashboard/staffs')->with('success','Staff Deleted Successfully');
    }
}
