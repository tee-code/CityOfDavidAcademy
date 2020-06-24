@extends('dashboard.app')

@section('dashboard')

<?php

    $expensesType = [
        "General" => "General",
        "Administrative" => "Administrative",
        "Fuel" => "Fuel"
    ];

    $expenseTypeKeys = [
        "General" => "General",
        "Administrative" => "Administrative",
        "Fuel" => "Fuel"
    ];


?>
<div class="container">

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Expenses') }}</p>
                <p class="card-category">{{ __('Here you can manage expenses') }}</p>
        </div>
        <div class="card-body">
                <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Expenses</button>
                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-theme-color">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add New Expense</h5>
                                <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class = "text-white" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['action' => 'ExpensesController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <div class="form-group row">
                                    {{ Form::label('type','Type',['class' => 'col-sm-2']) }}
                                    <div class="col-sm-10">
                                        {{ Form::select('type', $expenseTypeKeys, null, ['placeholder' => 'Pick a type...'])  }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                    <div class="col-sm-10">
                                        {{ Form::number('amount','',['placeholder' => 'amount e.g. 10000', 'class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('description','Description',['class' => 'col-sm-2']) }}
                                    <div class="col-sm-10">
                                        {{ Form::text('description','',['placeholder' => 'description', 'class' => 'form-control']) }}
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
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($expenses as $expense)
                            <tr>
                                <th scope="row">{{ $count }}</th>
                                <th scope="row">{{ $expense->type }}</th>
                                <th scope="row">{{ $expense->amount}}</th>
                                <th scope="row">{{ $expense->description }}</th>

                                <td>{{ (new DateTime($expense->created_at))->format('Y-m-d') }}</td>
                                <td>


                                        <span data-toggle="modal" data-target="#edit-{{ $expense->id }}" class="fas fa-pen-alt mx-1"></span>
                                        <div class="modal fade bd-example-modal-lg" id="edit-{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-theme-color">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $expense->type }} Record</h5>
                                                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class = "text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(['action' => ['ExpensesController@update',$expense->id],'method' => 'PUT']) !!}
                                                            <div class="form-group row">
                                                                    {{ Form::label('type','Type',['class' => 'col-sm-2']) }}
                                                                    <div class="col-sm-10">
                                                                        {{ Form::select('type', $expensesType,$expenseTypeKeys[$expense->type], ['placeholder' => 'Pick a type...'])  }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                                                    <div class="col-sm-10">
                                                                        {{ Form::number('amount',$expense->amount,['placeholder' => 'amount e.g. 10000', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    {{ Form::label('description','Description',['class' => 'col-sm-2']) }}
                                                                    <div class="col-sm-10">
                                                                        {{ Form::text('description',$expense->description,['placeholder' => 'description', 'class' => 'form-control']) }}
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


                                        <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $expense->id }}"></span>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Expenses Record</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete {{ $expense->message }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    {!! Form::open(['action' => ['ExpensesController@destroy',$expense->id], 'method' => 'POST']) !!}

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

                        {{ $expenses->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
