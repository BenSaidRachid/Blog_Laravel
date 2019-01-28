<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   	public function store($id)
    {
        if(!empty(request("body")))
        {
        	Comment::create([
	            "user_id" => auth()->id(),
	            "post_id" => $id,
	            "body" => request("body"),
        	]);
        }
        return back();
    }
    public function delete($id, Comment $comment)
    {
        if($comment->find($id))
        {
            if(auth()->id() == $comment->find($id)->user_id || \Auth::user()->isAdmin())
            {
                $comment->find($id)->delete();
            }
        }
        return back();
    }
    public function edit($id, Comment $comment)
    {
        if($comment->find($id))
        {
            if(auth()->id() == $comment->find($id)->user_id)
            {
                return view('post.commentEdit')->with("comment",$comment->find($id));
            }
            elseif (\Auth::user()->isAdmin()) {
                return view('admin.commentEdit')->with("comment",$comment->find($id));
            }
        }
        return redirect()->route("home");
    }
    public function update($id, Comment $comment)
    {
        if($comment->find($id))
        {
            $post_id = $comment->find($id)->post["id"];
            if(auth()->id() == $comment->find($id)->user_id)
            {
                 $comment->where('id', $id)
                ->update([
                    "body" => request("body")
                ]);
                return redirect('/post/'.$post_id);
            }
            elseif (\Auth::user()->isAdmin()) {
                 $comment->where('id', $id)
                ->update([
                    "body" => request("body")
                ]);
                return redirect('/admin/'.$post_id);
            }
        }
    }
}
