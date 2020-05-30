@extends('layouts.app')

@section('content')

    <div class="container mt-2">
        <a href="/posts" class="mb-2 btn btn-primary">Back</a>
        <h5 class="display-5 bg-primary p-2 text-white">{{ $post->title }}:</h5>
        <img class = "card-img-top" style = "width: 100%" src="{{ $post->cover_image }}" alt="post image">
        <br/>
        <div class = ""><p class="lead">{!!$post->body!!}</p></div>
        <h5 class = "lead bg-primary p-2 text-white"><i>Written on: {{ $post->created_at }} <strong>by {{ $post->user->name }}</strong></i></h5>
        <hr />

        @if (count($comments) > 1)
            <p class="lead float-left">{{count($comments)}} Comments</p>
        @else
            <p class="lead float-left">{{ count($comments) }} Comment</p>
        @endif

        @if (!auth()->guest())

            @if (auth()->user()->id === $post->user_id)
                <a class = "float-right" href="/posts/{{ $post->id }}/edit"><i class="fa-1x fas fa-pen-alt"></i></a>

                {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST']) !!}

                {{ Form::hidden('_method','DELETE') }}`

                {{ Form::button('<i class="fa-1x fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'float-right btn btn-sm']  )}}

                {!! Form::close() !!}
            @endif

        @endif
        <div class="clear"></div>

            @if (count($comments) > 0)
                @foreach ($comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <p class="lead">{!!$comment->comment!!}</p>
                        <p class=""><strong>Commented by: {{ $comment->commentedBy }} on {{ $comment->updated_at }}</strong></p>
                    </div>
                </div>
                @endforeach
                {{ $comments->links() }}

            @else
                <p class="lead">No Comment</p>
            @endif

            {!! Form::open(['action' => ['CommentsController@store',$post->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('comment','Comment') }}
                    {{ Form::textarea('comment','',['placeholder' => 'comment body', 'id' => 'editor', 'class' => 'form-control']) }}
                </div>
                {{ Form::submit('Submit Your Comment',['class' => 'mt-2 btn btn-block btn-primary']) }}
            {!! Form::close() !!}

        </div>

@endsection
