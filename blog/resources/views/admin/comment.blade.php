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
                </div>
                <p class="blog-post-meta">last update <span>{{$post->updated_at->diffForHumans()}}</span></p>
                <p class="blog-post-content">{!!$post->content!!}</p>
            </div>
            <div class="comment">
                <div class="list-group">
                    @foreach($post->comments->sortByDesc('updated_at') as $comment)
                    <div class="list-group-item">
                        <span><strong> {{$comment->user['firstname']}} {{$comment->user['lastname']}}</strong>
                            @if($comment->user['role'] == 1)
                                <i>Admin</i>
                            @endif  
                        </span>
                        <p class="blog-post-meta"><span><i>last update {{$comment->updated_at->diffForHumans()}}</i></span></p>
                        <p class="blog-post-content">{!!$comment->body!!}</p>
                        <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary">Edit</a>
                        <a href="/comment/{{$comment->id}}/delete" class="btn btn-danger">Delete</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @include('post.commentLayout')
        </div>
    </div>
</div>
@endsection