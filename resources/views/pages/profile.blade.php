@extends('dashboard.app')

@section('dashboard')

<div class="container">

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Edit Profile') }}</p>
                <p class="card-category">{{ __('User information') }}</p>
        </div>
        <div class="card-body">
            {!! Form::open(['action' => ['ProfileController@update',Auth::user()->id],'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group row">
                {{ Form::label('name','Name',['class' => 'col-sm-2']) }}
                <div class="col-sm-10">
                    {{ Form::text('name',Auth::user()->name,['placeholder' => 'name', 'class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('email','Email',['class' => 'col-sm-2']) }}
                <div class="col-sm-10">
                    {{ Form::email('email',Auth::user()->email,['placeholder' => 'email', 'class' => 'form-control']) }}
                </div>
            </div>

            {{Form::hidden('_method','PUT')}}
            {{ Form::submit('Save',['class' => 'mt-2 btn btn-block btn-primary']) }}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card container mt-3">
            <div class="card-header fancy-header">
                    <p class="card-title">{{ __('Change Password') }}</p>
                    <p class="card-category">{{ __('Password') }}</p>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => ['PasswordController@update',Auth::user()->id],'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    {{ Form::label('password','Current Password',['class' => 'col-sm-2']) }}
                    <div class="col-sm-10">
                        {{ Form::password('password',['placeholder' => 'password', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('password','New Password',['class' => 'col-sm-2']) }}
                    <div class="col-sm-10">
                        {{ Form::password('new_password',['placeholder' => 'password', 'class' => 'form-control']) }}
                    </div>
                </div>


                {{Form::hidden('_method','PUT')}}
                {{ Form::submit('Save',['class' => 'mt-2 btn btn-block btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>

</div>

@endsection
