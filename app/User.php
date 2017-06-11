<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected  $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function posts()
    {
        return $this->hasMany(Post::class,'author_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class,'from_user');
    }

    public function isAdmin()
    {
        $role=$this->role;
            if($role == 'admin')
            {
                return true;
            }
                return false;


    }
}
