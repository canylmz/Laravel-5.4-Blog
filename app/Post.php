<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    //
    protected  $table='posts';
    //posts table in database
    protected $guarded = [];
    public function comments()
    {
       // return $this->hasMany('App\Comments','on_post');
        return $this->hasMany(Comment::class,'on_post');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function scopeFilter($query,$filters){
        if($month = $filters['month']){
            $query->whereMonth('created_at',Carbon::parse($month)->month);
        }
        if($year = $filters['year']){
            $query->whereYear('created_at',$year);
        }
    }

    public function addComment($body)
    {
        $this->comments()->create([
            'body' =>$body,
            'from_user' =>Auth::id()
        ]);
    }

    public  static  function archives()
    {
        return static ::SelectRaw('year(created_at)as year, monthname(created_at) as month, count(*) as published')
            ->groupBy('year','month')
            ->orderBy('created_at','desc')
            ->orderByRaw('min(created_at)')
            ->get()
            ->toArray();

    }
}
