@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="blog-post">
                <div>
                    <h2 class="blog-post-title">
                        {{$post->title}}
                    </h2>
                    @if(Auth::user()->id == $post->user_id)
                        <a href="/post/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                        <a href="/post/{{$post->id}}/delete" class="btn btn-danger">Delete</a>
                    @endif
                </div>
                <p class="blog-post-meta">last update <span>{{$post->updated_at->diffForHumans()}}</span></p>
                <p class="blog-post-content">{!!$post->content!!}</p>
            </div>
            <div class="comment">
                <div class="list-group">
                    @foreach($post->comments->sortBy('updated_at') as $comment)
                    <div class="list-group-item">
                        <span><strong> {{$comment->user['firstname']}} {{$comment->user['lastname']}}</strong>
                            @if($comment->user['role'] == 1)
                                <i>Admin</i>
                            @endif  
                        </span>
                        <p class="blog-post-meta"><span><i>last update {{$comment->updated_at->diffForHumans()}}</i></span></p>
                        <p class="blog-post-content">{!!$comment->body!!}</p>
                        @if(Auth::user()->id == $comment->user_id)
                            <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary">Edit</a>
                            <a href="/comment/{{$comment->id}}/delete" class="btn btn-danger">Delete</a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @include('post.commentLayout')
        </div>
    </div>
</div>
@endsection