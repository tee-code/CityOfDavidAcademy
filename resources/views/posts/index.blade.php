@extends('layouts.app')

@section('content')
    <h5 class = "mt-4">Posts</h5>
    @if(count($posts) > 0)
        @foreach($posts as $post)

            <div class = "card">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <img class = "card-img-top" style = "width: 100%" src="{{ $post->cover_image }}" alt="post image">
                    </div>
                    <ul class = "col-sm-8 col-md-8 list-group list-group-flush">
                        <a href = "/posts/{{ $post->id }}" class = "list-group-item list-group-item-action">
                            <h5 class="display-5">{{ $post->title }}:</h5>
                            <small><i>Written on: {{ $post->created_at }} <strong>by {{ $post->user->name }}</strong></i></small>

                            @if (count($post->comments) > 1)
                                <p class="lead">{{ $post->commentSize }} comments</p>
                            @else
                                <p class="lead">{{ $post->commentSize }} comment</p>
                            @endif
                        </a>
                    </ul>
                </div>

            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <p class = "lead">No post</p>
    @endif
@endsection
