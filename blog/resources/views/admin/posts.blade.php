@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href="/admin/{{$post->id}}">
                        {{$post->title}}
                        </a>
                        <a href="/admin/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                        <a href="/admin/{{$post->id}}/delete" class="btn btn-danger">Delete</a>
                    </h2>
                    <h6>{{$post->user['firstname']}} {{$post->user['lastname']}}
                        @if($post->user['role'] == 1)
                            <span><i>Admin</i></span>
                        @endif  
                    </h6>
                    <p class="blog-post-meta"><i>last update <span>{{$post->updated_at->diffForHumans()}}</span></i></p>
                    <p class="blog-post-content">{!!$post->content!!}</p>
                    <a href="/admin/{{$post->id}}">
                        <p class="blog-comment-count">{{$post->comments->count()}} comments</p>
                    </a>
                </div>
            @endforeach
            {{$posts->render()}};
        </div>
    </div>
</div>
@endsection