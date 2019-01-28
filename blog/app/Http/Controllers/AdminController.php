<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Post;
use \App\User;
use \App\Comment;
class AdminController extends Controller
{
	public function index()
    {
        $users = User::latest()->limit(10)->get();
        $posts = Post::latest()->limit(10)->get();
        $comments = Comment::latest()->limit(10)->get();
    	return view('admin.admin')->with("last",
            array(
                'users' => $users,
                'posts' => $posts,
                'comments' => $comments
            )
        );
    }
    public function users()
    {
        $users = User::oldest()->paginate(10);
        return view('admin.users')->with("users",$users);
    }
    public function block($id)
    {
        if(User::find($id))
        {
            $user = User::find($id);
            $status = ($user->status) ? false : true;
            $user->where('id', $id)
                ->update([
                    "status" => $status 
                ]);
        }
        return back();
    }
    public function show($id)
    {
        if(Post::find($id))
            return view('admin.comment')->with("post",Post::find($id));
        
        return back();
    }
    public function posts()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts')->with("posts",$posts);
    }
    public function delete($id, Post $post)
    {
        if($post->find($id))
        {
            $post->find($id)->comments()->delete();
            $post->find($id)->delete();
            return back();
        }
        return redirect("/admin/post");
    }
    public function update($id, Post $post)
    {
        if($post->find($id))
        {
            $post->where('id', $id)
                ->update([
                    "title" => request("title"),
                    "content" => request("content")
                ]);
        }
        return redirect("/admin/post");
    }
    public function edit($id, Post $post)
    {
        if($post->find($id))
        {
            return view('admin.postEdit')->with("post",$post->find($id));
        }
        return back();
    }
}
