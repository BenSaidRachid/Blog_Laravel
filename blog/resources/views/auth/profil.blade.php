@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="blog-post">
                <p>{{$user['firstname']}}</p>
                <p>{{$user['lastname']}}</p>
                <p>{{$user['username']}}</p>
                <p>{{$user['email']}}</p>
                <a href="/profil/{{$user['id']}}/edit" class="btn btn-primary">Edit</a>
                <a href="/profil/{{$user['id']}}/delete" class="btn btn-danger">Delete</a>
                <br>
                <p class="block-user">
                    @if($user['status'] == 0)
                        User has been blocked
                    @endif  
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
