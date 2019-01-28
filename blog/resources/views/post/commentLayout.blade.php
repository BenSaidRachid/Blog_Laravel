<hr>
<div class="card">
    <div class="card-body">
        <form method="post" action="/post/{{$post->id}}/comments">
            @csrf
            <div class="form-group">
                <textarea id="body" type="text" class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" placeholder="Your comment here..." >{{old('body') }}</textarea>


                @if ($errors->has('body'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
             <div class="form-group">
                <button type="submit" class="btn btn-primary">
                   Add comment
                </button>
            </div>
        </form>
    </div>
</div>