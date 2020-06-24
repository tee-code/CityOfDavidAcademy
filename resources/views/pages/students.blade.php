@extends('dashboard.app')

@section('dashboard')

<div class="container">
    <?php

        $students = $data['students'];
        $sections = $data['sections'];
        $classes = $data['classes'];

        $terms = [
        "First Term" => "First Term",
        "Second Term" => "Second Term",
        "Third Term" => "Third Term",

    ];


    ?>

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Student') }}</p>
                <p class="card-category">{{ __('Here you can manage students') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Student</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Student</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'StudentsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('first_name','First Name:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::text('first_name','',['placeholder' => 'Your name', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('last_name','Last Name:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::text('last_name','',['placeholder' => 'Your surname', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('address','Address:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::text('address','',['placeholder' => 'address', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('phone_number','Phone Number:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::number('phone_number','',['placeholder' => 'telephone no', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('term_joined','Term Joined',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::select('term_joined', $terms, null, ['placeholder' => 'Pick a term...'])  }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('class_joined_id','Class Joined',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::select('class_joined_id', $classes, null, ['placeholder' => 'Pick a class...'])  }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            {{ Form::label('section_joined_id','Section Joined',['class' => 'col-sm-4']) }}
                                            <div class="col-sm-8">
                                                {{ Form::select('section_joined_id', $sections, null, ['placeholder' => 'Pick a section...'])  }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            {{ Form::label('current_class_id','Current Class',['class' => 'col-sm-4']) }}
                                            <div class="col-sm-8">
                                                {{ Form::select('current_class_id', $classes, null, ['placeholder' => 'Pick a class...'])  }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group row">
                                {{ Form::label('dob','Date of Birth',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::date('dob','',['placeholder' => '', 'class' => 'form-control']) }}
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
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">PhoneNumber</th>
                            <th scope="col">Address</th>
                            <th scope="col">Term Joined</th>
                            <th scope="col">Class Joined</th>
                            <th scope="col">Section Joined</th>
                            <th scope="col">Current Class</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Age</th>
                            <th scope="col">Discount Status</th>
                            <th scope=C"col">Outstanding Balance</th>
                            <th scope=C"col">School Fee</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($students as $student)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $student->first_name }}</th>
                            <td scope="row">{{ $student->last_name }}</td>
                            <td scope="row">{{ $student->phone_number }}</td>
                            <td scope="row">{{ $student->address }}</td>
                            <td scope="row">{{ $student->term_joined }}</td>
                            <td scope="row">{{ $student->class_joined }}</td>
                            <td scope="row">{{ $student->section_joined }}</td>
                            <td scope="row">{{ $student->current_class }}</td>
                            <td scope="row">{{ $student->dob }}</td>
                            <td scope="row">{{ $student->age }} years</td>
                            <th scope="row">{{ $student->discount_status }}</th>
                            <th scope="row">{{ $student->debit }}</th>
                            <th scope="row">
                                <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#view-{{ $student->id }}">View</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="view-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Fees Information</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                    @foreach ($student->schoolfee as $ss)
                                        <div class="card-body text-left">
                                                {!! $ss !!}
                                        </div>
                                    @endforeach


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
                            </th>

                            <td>{{ (new DateTime($student->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $student->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $student->full_name }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['StudentsController@update',$student->id],'method' => 'PUT']) !!}

                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('first_name','First Name:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::text('first_name',$student->first_name,['placeholder' => 'Your name', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('last_name','Last Name:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::text('last_name',$student->last_name,['placeholder' => 'Your surname', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('address','Address:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::text('address',$student->address,['placeholder' => 'address', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('phone_number','Phone Number:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::number('phone_number',$student->phone_number,['placeholder' => 'telephone no', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('term_joined','Term Joined',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('term_joined', $terms, $student->term_joined, ['placeholder' => 'Pick a term...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('class_joined_id','Class Joined',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('class_joined_id', $classes, $student->class_joined_id, ['placeholder' => 'Pick a class...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        {{ Form::label('section_joined_id','Section Joined',['class' => 'col-sm-4']) }}
                                                                        <div class="col-sm-8">
                                                                            {{ Form::select('section_joined_id', $sections, $student->section_joined_id, ['placeholder' => 'Pick a section...'])  }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        {{ Form::label('current_class_id','Current Class',['class' => 'col-sm-4']) }}
                                                                        <div class="col-sm-8">
                                                                            {{ Form::select('current_class_id', $classes, $student->current_class_id, ['placeholder' => 'Pick a class...'])  }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <div class="form-group row">
                                                            {{ Form::label('dob','Date of Birth',['class' => 'col-sm-2']) }}
                                                            <div class="col-sm-10">
                                                                {{ Form::date('dob',$student->dob,['placeholder' => '', 'class' => 'form-control']) }}
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

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $student->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Student Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $student->full_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['StudentsController@destroy',$student->id], 'method' => 'POST']) !!}

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

                    {{ $students->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
