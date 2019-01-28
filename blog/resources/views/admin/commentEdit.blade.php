@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="blog-post">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/comment/{{$comment->id}}/update">
                            @csrf
                            <div>
                                <h2 class="blog-post-title">
                                    Update comment
                                </h2>
                            </div>
                            <div class="form-group">
                                <textarea id="body" type="text" class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" placeholder="Your comment here..." >{{$comment->body}}</textarea>


                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                             <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                   Update comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection