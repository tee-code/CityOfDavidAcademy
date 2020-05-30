@extends('layouts.app')

@section('content')
    <h1 class = "mt-4">
        <a href="/posts" class="btn btn-primary">Back</a> Edit Post
    </h1>

    {!! Form::open(['action' => ['PostsController@update',$post->id],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title','Title') }}
            {{ Form::text('title',$post->title,['placeholder' => 'title', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body','Post Body') }}
            {{ Form::textarea('body',$post->body,['placeholder' => 'post body', 'id' => 'editor', 'class' => 'form-control']) }}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form::file('cover_image') }}
        {{ Form::submit('Edit New Post',['class' => 'mt-2 btn btn-block btn-primary']) }}
    {!! Form::close() !!}
@endsection
