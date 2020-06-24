@extends('dashboard.app')

@section('dashboard')

<div class="container">
    <?php

        $students = $data['students'];
        $sections = $data['sections'];
        $fees = $data['fees'];
        $schoolfees = $data['schoolfees'];

        $terms = [
        "First Term" => "First Term",
        "Second Term" => "Second Term",
        "Third Term" => "Third Term",

    ];

    $paymentMethods = [
        "Cash" => "Cash",
        "Transfer" => "Transfer",
        "Cheque" => "Cheque",

    ];


    ?>

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('School Fees') }}</p>
                <p class="card-category">{{ __('Here you can manage school fees') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Make Payment</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Make New Payment</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'SchoolFeesController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('student_id','Student Name:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::select('student_id', $students, null, ['placeholder' => 'Pick a student...'])  }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('section_id','Section',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::select('section_id', $sections, null, ['placeholder' => 'Pick a section...'])  }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            {{ Form::label('term','Term',['class' => 'col-sm-4']) }}
                                            <div class="col-sm-8">
                                                {{ Form::select('term', $terms, null, ['placeholder' => 'Pick a term...'])  }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            {{ Form::label('fees_id','Type of fee',['class' => 'col-sm-4']) }}
                                            <div class="col-sm-8">
                                                {{ Form::select('fees_id', $fees, null, ['placeholder' => 'Pick a fee...'])  }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group row">
                                {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::number('amount','',['placeholder' => '', 'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('payment_method','Payment Method',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('payment_method',$paymentMethods,null,['placeholder' => 'Pick payment method', 'class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{ Form::submit('Save',['class' => 'mt-2 btn btn-primary']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Student</th>
                            <th scope="col">Section</th>
                            <th scope="col">Class</th>
                            <th scope="col">Term</th>
                            <th scope="col">Fee Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($schoolfees as $schoolfee)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $schoolfee->student_name }}</th>
                            <td scope="row">{{ $schoolfee->section }}</td>
                            <td scope="row">{{ $schoolfee->classes }}</td>
                            <td scope="row">{{ $schoolfee->term }}</td>
                            <td scope="row">{{ $schoolfee->feeType}}</td>
                            <td scope="row">{{ $schoolfee->amount }}</td>

                            <td>{{ (new DateTime($schoolfee->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $schoolfee->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $schoolfee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $schoolfee->full_name }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['SchoolFeesController@update',$schoolfee->id],'method' => 'PUT']) !!}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{ Form::label('student_id','Student Name:',['class' => 'col-sm-4']) }}
                                                                <div class="col-sm-8">
                                                                    {{ Form::select('student_id', $students, $schoolfee->student_id, ['placeholder' => 'Pick a student...'])  }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{ Form::label('section_id','Section',['class' => 'col-sm-4']) }}
                                                                <div class="col-sm-8">
                                                                    {{ Form::select('section_id', $sections, $schoolfee->section_id, ['placeholder' => 'Pick a section...'])  }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('term','Term',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('term', $terms, $schoolfee->term, ['placeholder' => 'Pick a term...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('fees_id','Type of fee',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('fees_id', $fees, $schoolfee->fees_id, ['placeholder' => 'Pick a fee...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <div class="form-group row">
                                                        {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::number('amount',$schoolfee->amount,['placeholder' => '', 'class' => 'form-control']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ Form::label('payment_method','Payment Method',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::text('payment_method',$schoolfee->payment_method,['placeholder' => '', 'class' => 'form-control']) }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    {{Form::hidden('_method','PUT')}}
                                                    {{ Form::submit('Save',['class' => 'mt-2 btn btn-primary']) }}

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $schoolfee->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $schoolfee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Debtor Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $schoolfee->full_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['SchoolFeesController@destroy',$schoolfee->id], 'method' => 'POST']) !!}

                                                {{ Form::hidden('_method','DELETE') }}`

                                                {{ Form::button('Delete',['type' => 'submit', 'class' => 'btn btn-primary']  )}}

                                                {!! Form::close() !!}

                                                </div>
                                            </div>
                                            </div>
                                        </div>





                            </td>
                        </tr>
                        <?php $count++ ?>
                        @endforeach

                    {{ $schoolfees->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
