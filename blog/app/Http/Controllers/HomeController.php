<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\User;
use \App\Role;

class HomeController extends Controller
{
    public function index()
    {
    	$post =  Post::latest()->paginate(10);
        return view('home')->with("posts",$post);
    }
    public function show($id, User $user)
    {
    	if($user->find($id))
		{
			if(auth()->id() == $id)
   				return view("auth.profil")->with("user",User::find($id));
		}
       	return back();
    }
    public function delete($id, User $user)
    {
        if($user->find($id))
        {
            if(auth()->id() == $id)
            {
                $user->find($id)->id->delete();
            }
        }
        return redirect()->route("home");
    }
    public function update($id, User $user)
    {
        if($user->find($id))
        {
            $this->validate(request(),['firstname' => 'bail|required|string|max:255',
                'lastname' => 'bail|required|string|max:255',
                'username' => 'bail|required|string|max:255|unique:users',
                'birthdate' => 'required',
                'password' => 'bail|required|string|min:6|confirmed',
            ]);
            if(auth()->id() == $id)
            {
                 $user->where('id', $id)
                ->update([
                	'firstname' => request("firstname"),
		            'lastname' => request("lastname"),
		            'username' => request("username"),
		            'birthdate' => request("birthdate"),
		            'password' =>  bcrypt(request("password")),
                ]);
            }
            elseif (\Auth::user()->isAdmin()) {
                $user->where('id', $id)
                ->update([
                    'firstname' => request("firstname"),
                    'lastname' => request("lastname"),
                    'username' => request("username"),
                    'birthdate' => request("birthdate"),
                    'role' => request("role"),
                    'password' =>  bcrypt(request("password")),
                ]);
            }
        }
        return redirect()->route("home");
    }
    public function edit($id, User $user)
    {
        if($user->find($id))
        {
            if(auth()->id() == $id || \Auth::user()->isAdmin())
            {
                return view('auth.editProfil')->with("user", array(
                    'user' => $user->find($id),
                    'roles' => Role::all()
                 ));
            }
        }
        return redirect()->route("home");
    }
}
