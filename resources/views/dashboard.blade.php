@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary btn-block">Create New Post</a>
                    <hr>


                        @if(count($posts) > 0)
                        <table class="table table-responsive-md table-bordered table-hover">
                            <caption><h5>Your blog posts.</h5></caption>
                            <thead class = "thead-dark">
                                <tr>
                                    <th>Posts</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)

                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td><a href="/posts/{{ $post->id }}/edit"><i class="fas fa-pen-alt"></i></a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST']) !!}

                                            {{ Form::hidden('_method','DELETE') }}

                                            {{ Form::button('<i class="fa fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-sm'] )  }}

                                            {!! Form::close() !!}</td>
                                </tr>

                            @endforeach
                            @else
                                <img style = "width: 100%" src="/uploads/images/nopost.png" alt="No post image">
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
