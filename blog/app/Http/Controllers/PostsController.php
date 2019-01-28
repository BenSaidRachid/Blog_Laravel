<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use \App\Post;
class PostsController extends Controller
{
    protected $signedIn;
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       return redirect()->route("home");
    }
    public function create()
    {
        return view('post.posts');
    }
    public function show($id)
    {
        if(Post::find($id))
            return view('post.comment')->with("post",Post::find($id));
        return redirect()->route("home");
    }
   
    public function delete($id, Post $post)
    {
        if($post->find($id))
        {
            if(auth()->id() == $post->find($id)->user_id)
            {
                $post->find($id)->comments()->delete();
                $post->find($id)->delete();
            }
        }
        return redirect()->route("home");
    }
    public function update($id, Post $post)
    {
        if($post->find($id))
        {
            if(auth()->id() == $post->find($id)->user_id)
            {
                $this->validate(request(),[
                    'title' => 'bail|required|string|max:255',
                    'content' => 'bail|required|string'
                ]);
                 $post->where('id', $id)
                ->update([
                    "title" => request("title"),
                    "content" => request("content")
                ]);
            }
        }
        return redirect()->route("home");
    }
    public function edit($id, Post $post)
    {
        if($post->find($id))
        {
            if(auth()->id() == $post->find($id)->user_id)
            {
                return view('post.postEdit')->with("post",$post->find($id));
            }
        }
        return redirect()->route("home");
    }
    public function store()
    {
    	$this->validate(request(),[
            'title' => 'bail|required|string|max:255',
            'content' => 'bail|required|string'
        ]);
       	Post::create([
            "user_id" => auth()->id(),
       		"title" => request("title"),
       		"content" => request("content"),
       	]);
        return redirect()->route("home");
    }
}
