@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
	    <div class="lastTen">
	        <div>
	    		<h2>Users</h2>
	            @foreach($last["users"] as $user)

	                <div class="blog-post">
	                    <p>{{$user['firstname']}}</p>
	                    <p>{{$user['lastname']}}</p>
	                    <p>{{$user['username']}}</p>
	                    <p>{{$user['email']}}</p>
	                </div>
	            @endforeach
	        </div>
	    </div>
	    <div class="lastTen">
	        <div>
	    		<h2>Posts</h2>
	            @foreach($last["posts"] as $comment)
	                <div  class="blog-post">
	                	<h2 class="blog-post-title">
	                        {{$comment->title}}
	                    </h2>
	                    <span><strong> {{$comment->user['firstname']}} {{$comment->user['lastname']}}</strong>
	                        @if($comment->user['role'] == 1)
	                            <i>Admin</i>
	                        @endif  
	                    </span>
	                    <p class="blog-post-meta"><span><i>last update {{$comment->updated_at->diffForHumans()}}</i></span></p>
	                    <p class="blog-post-content">{!!$comment->content!!}</p>
	                </div>
	            @endforeach
	        </div>
	    </div>
	    <div class="lastTen">
	        <div>
	    		<h2>Comments</h2>
	            @foreach($last["comments"] as $post)
	                <div class="list-group-item">
	                    <h6>{{$post->user['firstname']}} {{$post->user['lastname']}}
	                        @if($post->user['role'] == 1)
	                            <span><i>Admin</i></span>
	                        @endif  
	                    </h6>
	                    <p class="blog-post-meta"><i>last update <span>{{$post->updated_at->diffForHumans()}}</span></i></p>
	                    <p class="blog-post-content">{!!$post->body!!}</p>
	                </div>
	            @endforeach
	        </div>
	    </div>
    </div>
</div>
@endsection