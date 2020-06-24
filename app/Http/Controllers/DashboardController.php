<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Section;
use App\Classes;
use App\Fees;
use App\Student;
use App\Staff;
use App\StudentFees;
use App\Debtor;
use App\Allowance;
use App\Tax;
use App\Expenses;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $no_of_students = Student::all()->count();
        $no_of_staffs = Staff::all()->count();
        $no_of_fees = Fees::all()->count();
        $no_of_classes = Classes::all()->count();
        $no_of_sections = Section::all()->count();
        $no_of_users = User::all()->count();

        $staffMembers = Staff::orderBy("first_name","asc")->paginate(4);
        $student_fees = StudentFees::orderBy('created_at','desc')->paginate(4);
        $debtors = Debtor::orderBy('created_at','desc')->paginate(4);
        $taxes  = Tax::orderBy('created_at','desc')->paginate(4);
        $allowances  = Allowance::orderBy('created_at','desc')->paginate(4);
        $expences  = Expenses::orderBy('created_at','desc')->paginate(4);

        $sections = Section::all();
        $fees = Fees::all();
        $classes = Classes::all();

        $students = Student::all();

        $jan_students = [];
        $feb_students = [];
        $mar_students = [];
        $april_students = [];
        $may_students = [];
        $june_students = [];
        $july_students = [];
        $aug_students = [];
        $sep_students = [];
        $oct_students = [];
        $nov_students = [];
        $dec_students = [];

        $jan_staffs = [];
        $feb_staffs = [];
        $mar_staffs = [];
        $april_staffs = [];
        $may_staffs = [];
        $june_staffs = [];
        $july_staffs = [];
        $aug_staffs = [];
        $sep_staffs = [];
        $oct_staffs = [];
        $nov_staffs = [];
        $dec_staffs = [];


        foreach ($students as $student) {
            $student->full_name = $student->first_name . " " . $student->last_name;
            $month = date_format(date_create($student->dob),'M');


            switch ($month) {
                case 'Jan':
                     array_push($jan_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Feb':
                     array_push($feb_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Mar':
                     array_push($mar_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Apr':
                     array_push($april_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'May':
                     array_push($may_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Jun':
                     array_push($june_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Jul':
                     array_push($july_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Aug':
                     array_push($aug_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Sep':
                     array_push($sep_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Oct':
                     array_push($oct_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Nov':
                     array_push($nov_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
                case 'Dec':
                     array_push($dec_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;

                default:
                    array_push($dec_students,$student->full_name . ": " . date_format(date_create($student->dob),'d M'));
                    break;
            }

        }

        foreach ($staffMembers as $staff) {
            $staff->full_name = $staff->first_name . " " . $staff->last_name;
            $month = date_format(date_create($staff->dob),'M');

            switch ($month) {
                case 'Jan':
                     array_push($jan_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Feb':
                     array_push($feb_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Mar':
                     array_push($mar_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Apr':
                     array_push($april_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'May':
                     array_push($may_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Jun':
                     array_push($june_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Jul':
                     array_push($july_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Aug':
                     array_push($aug_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Sep':
                     array_push($sep_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Oct':
                     array_push($oct_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Nov':
                     array_push($nov_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
                case 'Dec':
                     array_push($dec_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;

                default:
                    array_push($dec_staffs,$staff->full_name . ": " . date_format(date_create($staff->dob),'d M'));
                    break;
            }

        }

        $fees = $fees->pluck('feesType','id');

        $totalFees = 0.0;
        $totalExpenses = 0.0;
        $totalDebts = 0.0;
        $totalAllowances = 0.0;
        $totalTax = 0.0;

        foreach ($student_fees as $student_fee) {

            $student = Student::findOrFail($student_fee->student_id);
            $cls = Classes::findOrFail($student_fee->classes_id);
            $section = Section::findOrFail($student_fee->section_id);
            $fee = Fees::findOrFail($student_fee->fees_id);

            $totalFees += $student_fee->amount;
            $student_fee->student_name = $student->first_name . ' ' . $student->last_name;
            $student_fee->section = $section->section;
            $student_fee->classes = $cls->classes;
            $student_fee->feeType = $fee->feesType;
        }

        foreach ($debtors as $debtor) {

            $totalDebts += $debtor->amount;
            $student = Student::findOrFail($debtor->student_id);
            $classes = Classes::find($debtor->classes_id);
            $fee = Fees::findOrFail($debtor->fees_id);
            $section = Section::findOrFail($debtor->section_id);

            $debtor->student_name = $student->first_name . ' ' . $student->last_name;
            $debtor->section = $section->section;
            $debtor->feeType = $fee->feesType;
            $debtor->classes = $classes->classes;

        }

        foreach ($expences as $expense) {
            $totalExpenses += $expense->amount;
        }

        foreach ($allowances as $allowance) {

            $staff = Staff::find($allowance->staff_id);
            $totalAllowances += $allowance->amount;

            $allowance->staff_name = $staff->first_name . " " . $staff->last_name;

        }

        foreach ($taxes as $tax) {

            $totalTax += $tax->amount;

            $staff = Staff::find($tax->staff_id);

            $tax->staff_name = $staff->first_name . " " . $staff->last_name;

        }

        $data = [
            "users" => $no_of_users,
            "students" => $no_of_students,
            "staffs" => $no_of_staffs,
            "fees" => $no_of_fees,
            "classes" => $no_of_classes,
            "sections" => $no_of_sections,
            "staffMembers" => $staffMembers,
            "payments" => $student_fees,
            "expenses" => $expences,
            "debtors" => $debtors,
            "allowances" => $allowances,
            "taxes" => $taxes,
            "totalDebts" => $totalDebts,
            "totalExpenses" => $totalExpenses,
            "totalFees" => $totalFees,
            "totalAllowances" => $totalAllowances,
            "totalTax" => $totalTax,
            "jan_students" => $jan_students,
            "feb_students" => $feb_students,
            "mar_students" => $mar_students,
            "april_students" => $april_students,
            "may_students" => $may_students,
            "june_students" => $june_students,
            "july_students" => $july_students,
            "aug_students" => $aug_students,
            "sep_students" => $sep_students,
            "oct_students" => $oct_students,
            "nov_students" => $nov_students,
            "dec_students" => $dec_students,
            "jan_staffs" => $jan_staffs,
            "feb_staffs" => $feb_staffs,
            "mar_staffs" => $mar_staffs,
            "april_staffs" => $april_staffs,
            "may_staffs" => $may_staffs,
            "june_staffs" => $june_staffs,
            "july_staffs" => $july_staffs,
            "aug_staffs" => $aug_staffs,
            "sep_staffs" => $sep_staffs,
            "oct_staffs" => $oct_staffs,
            "nov_staffs" => $nov_staffs,
            "dec_staffs" => $dec_staffs,



        ];

        return view('pages.dashboard')->with("data",$data);
    }


}
