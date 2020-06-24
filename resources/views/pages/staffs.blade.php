@extends('dashboard.app')

@section('dashboard')

<div class="container">
    <?php

        $staffs = $data['staffs'];
        $sections = $data['sections'];

        $terms = [
        "First Term" => "First Term",
        "Second Term" => "Second Term",
        "Third Term" => "Third Term",

    ];


    ?>

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Staff') }}</p>
                <p class="card-category">{{ __('Here you can manage staffs') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Staff</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Staff</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'StaffsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                                        {{ Form::label('email','Email Address:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::email('email','',['placeholder' => 'email', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {{ Form::label('basic_salary','Basic Salary:',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::number('basic_salary','',['placeholder' => 'salary', 'class' => 'form-control']) }}
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
                                        {{ Form::label('section_joined_id','Section Joined',['class' => 'col-sm-4']) }}
                                        <div class="col-sm-8">
                                            {{ Form::select('section_joined_id', $sections, null, ['placeholder' => 'Pick a section...'])  }}
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
                            <th scope="col">Email</th>
                            <th scope="col">Basic Salary</th>
                            <th scope="col">Allowance</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Total</th>
                            <th scope="col">Term Joined</th>

                            <th scope="col">Section Joined</th>

                            <th scope="col">DOB</th>
                            <th scope="col">Age</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($staffs as $staff)
                        <tr>
                            <th scope="row">{{ $count }}</th>
                            <th scope="row">{{ $staff->first_name }}</th>
                            <td scope="row">{{ $staff->last_name }}</td>
                            <td scope="row">{{ $staff->phone_number }}</td>
                            <td scope="row">{{ $staff->address }}</td>
                            <td scope="row">{{ $staff->email }}</td>
                            <td scope="row">{{ $staff->basic_salary }}</td>
                            <td scope="row">{{ $staff->allowance }}</td>
                            <td scope="row">{{ $staff->tax }}</td>
                            <td scope="row">{{ $staff->total }}</td>
                            <td scope="row">{{ $staff->term_joined }}</td>

                            <td scope="row">{{ $staff->section_joined }}</td>

                            <td scope="row">{{ $staff->dob }}</td>
                            <td scope="row">{{ $staff->age }} years</td>

                            <td>{{ (new DateTime($staff->created_at))->format('Y-m-d') }}</td>
                            <td>
                                <span data-toggle="modal" data-target="#edit-{{ $staff->id }}" class="fas fa-pen-alt mx-1"></span>

                                <div class="modal fade bd-example-modal-lg" id="edit-{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-theme-color">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $staff->full_name }} Record</h5>
                                                    <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class = "text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['StaffsController@update',$staff->id],'method' => 'PUT']) !!}

                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('first_name','First Name:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::text('first_name',$staff->first_name,['placeholder' => 'Your name', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('last_name','Last Name:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::text('last_name',$staff->last_name,['placeholder' => 'Your surname', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('address','Address:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::text('address',$staff->address,['placeholder' => 'address', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('phone_number','Phone Number:',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::number('phone_number',$staff->phone_number,['placeholder' => 'telephone no', 'class' => 'form-control']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        {{ Form::label('email','Email Address:',['class' => 'col-sm-4']) }}
                                                                        <div class="col-sm-8">
                                                                            {{ Form::email('email',$staff->email,['placeholder' => 'email', 'class' => 'form-control']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        {{ Form::label('basic_salary','Basic Salary:',['class' => 'col-sm-4']) }}
                                                                        <div class="col-sm-8">
                                                                            {{ Form::number('basic_salary',$staff->basic_salary,['placeholder' => 'salary', 'class' => 'form-control']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('term_joined','Term Joined',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('term_joined', $terms, $staff->term_joined, ['placeholder' => 'Pick a term...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{ Form::label('section_joined_id','Section Joined',['class' => 'col-sm-4']) }}
                                                                    <div class="col-sm-8">
                                                                        {{ Form::select('section_joined_id', $sections, $staff->section_joined_id, ['placeholder' => 'Pick a section...'])  }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            {{ Form::label('dob','Date of Birth',['class' => 'col-sm-2']) }}
                                                            <div class="col-sm-10">
                                                                {{ Form::date('dob',$staff->dob,['placeholder' => '', 'class' => 'form-control']) }}
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

                                    <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $staff->id }}"></span>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Student Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete {{ $staff->full_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::open(['action' => ['StaffsController@destroy',$staff->id], 'method' => 'POST']) !!}

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

                    {{ $staffs->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
