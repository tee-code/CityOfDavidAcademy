@extends('dashboard.app')

@section('dashboard')

<div class="container">

    <?php

        $staffs = $data['staffs'];
        $allowances = $data['allowances'];


    ?>

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Allowance') }}</p>
                <p class="card-category">{{ __('Here you can manage allowances') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Allowance</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Allowance</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'AllowancesController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            {{ Form::label('staff_id','Staff Name:',['class' => 'col-sm-4']) }}
                                            <div class="col-sm-8">
                                                {{ Form::select('staff_id', $staffs, "", ['placeholder' => 'Pick a staff...'])  }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            {{ Form::label('type','Type',['class' => 'col-sm-4']) }}
                                            <div class="col-sm-8">
                                                {{ Form::text('type', "", ['placeholder' => 'Allowance on what.'])  }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                    <div class="col-sm-10">
                                        {{ Form::number('amount',"",['placeholder' => '', 'class' => 'form-control']) }}
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
                            <th scope="col">Staff Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($allowances as $allowance)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $allowance->staff_name }}</th>
                            <td scope="row">{{ $allowance->type }}</td>
                            <td scope="row">{{ $allowance->amount }}</td>

                            <td>{{ (new DateTime($allowance->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $allowance->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $allowance->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $allowance->staff_name }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['AllowancesController@update',$allowance->id],'method' => 'PUT']) !!}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{ Form::label('staff_id','Staff Name:',['class' => 'col-sm-4']) }}
                                                                <div class="col-sm-8">
                                                                    {{ Form::select('staff_id', $staffs, $allowance->staff_id, ['placeholder' => 'Pick a staff...'])  }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{ Form::label('type','Type',['class' => 'col-sm-4']) }}
                                                                <div class="col-sm-8">
                                                                    {{ Form::text('type', $allowance->type, ['placeholder' => 'Allowance on what.'])  }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::number('amount',$allowance->amount,['placeholder' => '', 'class' => 'form-control']) }}
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

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $allowance->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $allowance->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Allowance Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $allowance->full_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['AllowancesController@destroy',$allowance->id], 'method' => 'POST']) !!}

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

                    {{ $allowances->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
