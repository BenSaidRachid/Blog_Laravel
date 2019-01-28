@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($users as $user)
                <div class="blog-post">
                    <p>{{$user['firstname']}}</p>
                    <p>{{$user['lastname']}}</p>
                    <p>{{$user['username']}}</p>
                    <p>{{$user['email']}}</p>
                    <a href="/profil/{{$user['id']}}/edit" class="btn btn-primary">Edit</a>
                    @if($user['role'] != 1)
                        <a href="/admin/{{$user['id']}}/block" class="btn btn-danger">
                            Block/Unblock
                        </a>
                    @endif  
                    <br>
                    <p class="block-user">
                        @if($user['status'] == 0)
                            User has been blocked
                        @endif  
                    </p>
                </div>
            @endforeach
            {{$users->render()}};
        </div>
    </div>
</div>
@endsection
