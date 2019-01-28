<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "firstname","lastname","username","birthdate","email","password"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isAdmin()
    {
        return ($this->role == 1) ? true : false;
    }
    public function isAvailable()
    {
        return $this->status;
    }
    public function isPost()
    {
        return ($this->role != 3) ? true : false;
    }
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
