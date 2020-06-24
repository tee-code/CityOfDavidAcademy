@extends('dashboard.app')

@section('dashboard')

<?php
    $icons = ["fa-user-cog text-info","fa-calendar text-success","fa-graduation-cap text-danger","fa-money-bill-alt text-danger","fa-user text-success","fa-user text-info"];
    $titles = ["Users","Sections","Classes","Fees","Students","Staff"];

    $numbers = [$data["users"],$data["sections"],$data["classes"],$data["fees"],$data["students"],$data["staffs"]];

    $staffs = $data["staffMembers"];
    $payments = $data["payments"];
    $expenses = $data["expenses"];
    $debtors = $data["debtors"];
    $taxes = $data["taxes"];
    $allowances = $data["allowances"];
    $totalDebts = $data["totalDebts"];
    $totalExpenses = $data["totalExpenses"];
    $totalFees = $data["totalFees"];
    $totalAllowances = $data["totalAllowances"];
    $totalTax = $data["totalTax"];
    $june_staffs = $data["june_staffs"];

    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November","December"];
    $month = ["jan", "feb", "mar", "april", "may", "june", "july", "aug", "sep", "oct", "nov","dec"];

?>

<div class="container-fluid mt-3">

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @for ($i = 0; $i < 6; $i++)
                    <div class="col-sm-4 p-2">
                        <div class="card">
                            <div class="dashboard card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas {{ $icons[$i] }} fa-2x"></i>
                                    <div class="text-right">
                                        <div class="text-right">
                                            <p>{{ $titles[$i] }}</h5>
                                            <h5>{{ $numbers[$i] }}</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-secondary">
                                <i class="fas fa-sync mr-1 text-warning">
                                </i>
                                <span>Updated Now</span>
                            </div>
                        </div>

                    </div>

                @endfor

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-xl-6 mt-2">
                    <p class = "bg-primary p-1 text-center text-white">Staff Salary</p>
                    <table class ="table text-center table-striped table-blue table-responsive">
                        <thead>
                            <tr class="text-muted">
                                <th>#</th>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Basic Salary</td>
                                <td>Phone Number</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <th>{{  $i }}</th>
                                    <td>{{  $staff->first_name }}</td>
                                    <td>{{  $staff->last_name }}</td>
                                    <td>{{  $staff->basic_salary }}</td>
                                    <td>{{  $staff->phone_number }}</td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            {{ $staffs->links() }}

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-xl-6 mt-2">
                    <p class ="bg-danger p-1 text-center text-white">Recent Payment</p>
                    <table class ="table text-center table-striped table-responsive">
                            <thead>
                                <tr class="text-muted">
                                    <th>#</th>
                                    <td>Name</td>
                                    <td>Section</td>
                                    <td>Class</td>
                                    <td>Term</td>
                                    <td>Fee</td>
                                    <td>Amount</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <th>{{  $i }}</th>
                                            <td>{{  $payment->student_name }}</td>
                                            <td>{{  $payment->section }}</td>
                                            <td>{{  $payment->classes }}</td>
                                            <td>{{  $payment->term }}</td>
                                            <td>{{  $payment->feeType }}</td>
                                            <td>{{  $payment->amount }}</td>
                                            <td>{{ (new DateTime($payment->updated_at))->format('Y-m-d') }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                        <button class="btn btn-primary btn-block">Total: {{ $totalFees }}</button>
                                    {{ $payments->links() }}

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 mt-2">
                        <p class = "bg-primary p-1 text-center text-white">Tax Deduction</p>
                        <table class ="table text-center table-striped table-blue table-responsive">
                            <thead>
                                <tr class="text-muted">
                                    <th>#</th>
                                    <td>Staff Name</td>
                                    <td>Type</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($taxes as $tax)
                                    <tr>
                                        <th>{{  $i }}</th>
                                        <td>{{  $tax->staff_name }}</td>
                                        <td>{{  $tax->type }}</td>
                                        <td>{{  $tax->amount }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                <button class="btn btn-primary btn-block">Total: {{ $totalTax }}</button>
                                {{ $staffs->links() }}

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-xl-6 mt-2">
                        <p class ="bg-danger p-1 text-center text-white">Allowances</p>
                        <table class ="table text-center table-striped table-responsive">
                                <thead>
                                    <tr class="text-muted">
                                        <th>#</th>
                                        <td>Staff Name</td>
                                        <td>Type</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($allowances as $allowance)
                                            <tr>
                                                <th>{{  $i }}</th>
                                                <td>{{  $allowance->staff_name }}</td>
                                                <td>{{  $allowance->type }}</td>
                                                <td>{{  $allowance->amount }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                        <button class="btn btn-primary btn-block">Total: {{ $totalAllowances }}</button>
                                        {{ $payments->links() }}

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 mt-2">
                            <p class = "bg-primary p-1 text-center text-white">Debtors</p>
                            <table class ="table text-center table-striped table-blue table-responsive">
                                <thead>
                                    <tr class="text-muted">
                                        <th>#</th>
                                        <td>Debtor Name</td>
                                        <td>Class</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($debtors as $debtor)
                                        <tr>
                                            <th>{{  $i }}</th>
                                            <td>{{  $debtor->student_name }}</td>
                                            <td>{{  $debtor->classes }}</td>
                                            <td>{{  $debtor->amount }}</td>

                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                    <button class="btn btn-primary btn-block">Total: {{ $totalDebts }}</button>
                                    {{ $debtors->links() }}

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-xl-6 mt-2">
                            <p class ="bg-danger p-1 text-center text-white">Expenses</p>
                            <table class ="table text-center table-striped table-responsive">
                                    <thead>
                                        <tr class="text-muted">
                                            <th>#</th>
                                            <td>Type</td>
                                            <td>Amount</td>
                                            <td>Desciption</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($expenses as $expense)
                                                <tr>
                                                    <th>{{  $i }}</th>
                                                    <td>{{  $expense->type }}</td>
                                                    <td>{{  $expense->amount }}</td>
                                                    <td>{{  $expense->description }}</td>
                                                    <td>{{ (new DateTime($payment->updated_at))->format('Y-m-d') }}</td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <button class="btn btn-primary btn-block">Total: {{ $totalExpenses }}</button>
                                            {{ $expenses->links() }}

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <p class = "bg-theme-color p-1 text-center text-white">Staff Birthday</p>
                    @for ($i = 0; $i < 12; $i++)
                        <button class="accordion text-white btn bg-primary btn-block mt-2">{{ $months[$i] }}</button>
                        <div class="panel">
                        @foreach ($data["$month[$i]_staffs"] as $m)
                            <p class="lead mt-1">{{  $m }}</p>
                        @endforeach

                    </div>
                    @endfor

                </div>
                <div class="col-lg-6">
                    <p class = "bg-primary p-1 text-center text-white">Students Birthday</p>
                    @for ($i = 0; $i < 12; $i++)
                        <button class="accordion text-white btn bg-danger btn-block mt-2">{{ $months[$i] }}</button>
                        <div class="panel">
                        @foreach ($data["$month[$i]_students"] as $m)
                            <p class="lead mt-1">{{  $m }}</p>
                        @endforeach

                    </div>
                    @endfor
                </div>
            </div>

</div>

@endsection
