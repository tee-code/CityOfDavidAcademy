@extends('dashboard.app')

@section('dashboard')

<div class="container">
    <?php

        $students = $data['students'];
        $sections = $data['sections'];
        $fees = $data['fees'];

        $discounts = $data['discounts'];

        $terms = [
        "First Term" => "First Term",
        "Second Term" => "Second Term",
        "Third Term" => "Third Term",

    ];


    ?>

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Discounts') }}</p>
                <p class="card-category">{{ __('Here you can manage discounts') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Discount</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Discount</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'DiscountsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('student_id','Discount For:',['class' => 'col-sm-4']) }}
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
                            <th scope="col">Discount For</th>
                            <th scope="col">Section</th>
                            <th scope="col">Term</th>
                            <th scope="col">Class</th>
                            <th scope="col">Fee Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($discounts as $discount)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $discount->student_name }}</th>
                            <td scope="row">{{ $discount->section }}</td>
                            <td scope="row">{{ $discount->term }}</td>
                            <td scope="row">{{ $discount->classes }}</td>
                            <td scope="row">{{ $discount->feeType}}</td>
                            <td scope="row">{{ $discount->amount }}</td>

                            <td>{{ (new DateTime($discount->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $discount->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $discount->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $discount->full_name }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['DiscountsController@update',$discount->id],'method' => 'PUT']) !!}

                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('student_id','Discount For:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('student_id', $students, $discount->student_id, ['placeholder' => 'Pick a student...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('section_id','Section',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('section_id', $sections, $discount->section_id, ['placeholder' => 'Pick a section...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        {{ Form::label('term','Term',['class' => 'col-sm-4']) }}
                                                                        <div class="col-sm-8">
                                                                            {{ Form::select('term', $terms, $discount->term, ['placeholder' => 'Pick a term...'])  }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        {{ Form::label('fees_id','Current Class',['class' => 'col-sm-4']) }}
                                                                        <div class="col-sm-8">
                                                                            {{ Form::select('fees_id', $fees, $discount->fees_id, ['placeholder' => 'Pick a fee...'])  }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <div class="form-group row">
                                                            {{ Form::label('amount','Amount',['class' => 'col-sm-2']) }}
                                                            <div class="col-sm-10">
                                                                {{ Form::number('amount',$discount->amount,['placeholder' => '', 'class' => 'form-control']) }}
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

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $discount->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $discount->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Discount Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $discount->full_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['DiscountsController@destroy',$discount->id], 'method' => 'POST']) !!}

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

                    {{ $discounts->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
