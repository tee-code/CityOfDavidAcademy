@extends('dashboard.app')

@section('dashboard')

<div class="container">

    <?php

        $staffs = $data['staffs'];
        $taxes = $data['taxes'];


    ?>

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Taxes') }}</p>
                <p class="card-category">{{ __('Here you can manage taxes') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Tax</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Tax</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'TaxesController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

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
                                                {{ Form::text('type', "", ['placeholder' => 'Tax on what.'])  }}
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
                        @foreach ($taxes as $tax)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $tax->staff_name }}</th>
                            <td scope="row">{{ $tax->type }}</td>
                            <td scope="row">{{ $tax->amount }}</td>

                            <td>{{ (new DateTime($tax->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $tax->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $tax->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $tax->staff_name }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['TaxesController@update',$tax->id],'method' => 'PUT']) !!}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{ Form::label('staff_id','Staff Name:',['class' => 'col-sm-4']) }}
                                                                <div class="col-sm-8">
                                                                    {{ Form::select('staff_id', $staffs, $tax->staff_id, ['placeholder' => 'Pick a staff...'])  }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{ Form::label('type','Type',['class' => 'col-sm-4']) }}
                                                                <div class="col-sm-8">
                                                                    {{ Form::text('type', $tax->type, ['placeholder' => 'Tax on what.'])  }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::number('amount',$tax->amount,['placeholder' => '', 'class' => 'form-control']) }}
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

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $tax->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $tax->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Tax Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $tax->full_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['TaxesController@destroy',$tax->id], 'method' => 'POST']) !!}

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

                    {{ $taxes->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
