<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    //
    protected $guarded = [];
    protected  $table='comments';
    // user who commented
    public function users()
    {
        return $this->belongsTo(User::class,'from_user');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'on_post');
    }


}
