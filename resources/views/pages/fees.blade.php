@extends('dashboard.app')

@section('dashboard')

<div class="container">
    <?php
        $fees = $data['fees'];
        $classes = $data['cls'];


    ?>
    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Fees') }}</p>
                <p class="card-category">{{ __('Here you can manage fees') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Fees</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Fees</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'FeesController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group row">
                                {{ Form::label('feesType','FeesType',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('feesType','',['placeholder' => 'fee e.g. School Fee', 'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('feesAmount','FeesAmount',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::number('feesAmount','',['placeholder' => 'amount e.g. 10000', 'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('feesClass','FeesClass',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('class_id', $classes, null, ['placeholder' => 'Pick a class...'])  }}
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
                            <th scope="col">FeesType</th>
                            <th scope="col">FeesAmount</th>
                            <th scope="col">Class</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($fees as $fee)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $fee->feesType }}</th>
                            <th scope="row">{{ $fee->feesAmount }}</th>
                            <th scope="row">{{ $fee->classes->classes }}</th>
                            <td>{{ (new DateTime($fee->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $fee->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $fee->feesType }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['FeesController@update',$fee->id],'method' => 'PUT']) !!}
                                                    <div class="form-group row">
                                                        {{ Form::label('feesType','FeesType',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::text('feesType',$fee->feesType,['placeholder' => 'Fee e.g. School Fee', 'class' => 'form-control']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ Form::label('feesAmount','FeesAmount',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::number('feesAmount',$fee->feesAmount,['placeholder' => 'Fee e.g. 10000', 'class' => 'form-control']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ Form::label('feesClass','FeesClass',['class' => 'col-sm-2']) }}
                                                        <div class="col-sm-10">
                                                            {{ Form::select('class_id', $classes, $fee->classes_id, ['placeholder' => 'Pick a class...'])  }}
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

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $fee->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Fees Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $fee->feesType }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['FeesController@destroy',$fee->id], 'method' => 'POST']) !!}

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

                    {{ $fees->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
