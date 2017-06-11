<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function profile(Request $request, $id=1)
    {
        $data['user'] = User::find($id);
        if (!$data['user'])
            return redirect('/');

        if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
            $data['author'] = true;
        } else {
            $data['author'] = null;
        }
        $data['comments_count']  = $data['user']->comments->count();
        $data['posts_count']     = $data['user']->posts->count();
        $data['latest_posts']    = $data['user']->posts->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);

        return view('pages.profile')->withData($data);
    }

    public function user_posts_all()
    {
        $posts=Post::where('author_id',Auth::id())->orderBy('created_at','desc')->paginate(5);
            $title= 'My All Post ';

        return view('pages.blog')->withPosts($posts)->withTitle($title);
    }

    public function user_posts($id)
    {
        $posts=Post::where('author_id',$id)->orderBy('created_at','desc')->paginate(5);
        $users=User::find($id);

        $title='<a href="/profile/'.$users->id.'">'.$users->name.'</a> \'s Posts';
        return view('pages.blog')->withPosts($posts)->withTitle($title);
    }


}
