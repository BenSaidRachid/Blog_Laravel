<div class="blog-post">
	<h2 class="blog-post-title">
		<a href="/post/{{$post->id}}">
		{{$post->title}}
		</a>
	</h2>
	<h6>{{$post->user['firstname']}} {{$post->user['lastname']}} 
		@if($post->user['role'] == 1)
			<span><i>Admin</i></span>
		@endif		
	</h6>
	<p class="blog-post-meta"><i>last update <span>{{$post->updated_at->diffForHumans()}}</span></i></p>
	<p class="blog-post-content">{!!$post->content!!}</p>
	<a href="/post/{{$post->id}}">
		<p class="blog-comment-count">{{$post->comments->count()}} comments</p>
	</a>
</div>