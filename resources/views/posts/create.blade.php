@extends('layouts.app')

@section('content')
    <h1 class = "mt-4">Create Post</h1>

    {!! Form::open(['action' => 'PostsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title','Title') }}
            {{ Form::text('title','',['placeholder' => 'title', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body','Post Body') }}
            {{ Form::textarea('body','',['placeholder' => 'post body', 'id' => 'editor', 'class' => 'form-control']) }}
        </div>
        {{ Form::file('cover_image') }}
        @csrf
        {{ Form::submit('Add New Post',['class' => 'btn btn-block btn-primary mt-2']) }}
    {!! Form::close() !!}
@endsection
