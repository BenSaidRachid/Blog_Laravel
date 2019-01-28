@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                @include("post.postRender")
            @endforeach
            {{$posts->render()}}
            @if(Auth::check())
                @if(Auth::user()->isPost())
                <div class="card">
                    <div class="card-header">Posts</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/post/new" class="btn btn-primary">Publier un post</a>
                    </div>
                </div> 
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
