<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
       if(request('month')){
           $posts = Post::latest()->filter(request(['month','year']))->orderBy('created_at','desc')->paginate(5)   ;
       }
        else{
            $posts = Post::orderBy('created_at','desc')->paginate(5);
        }
        $title="Latest Posts";
        if(request('search')){
            $posts=Post::where('title', 'LIKE', '%'.request()->search.'%')->orderBy('created_at','desc')->paginate(5);
            $title="Searched Word : ".request()->search;
        };
        return view('pages.blog')->withPosts($posts)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
            return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PostFormRequest $formRequest)
    {
        $formRequest->PostSave();
        session()->flash('message', "Your Post Has Now Been Published. ");
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        //??
        $post= Post::where('slug',$slug)->first();
        if (!$post)
            return redirect('/');

        $posts= Post::where('slug',$slug)->get();
        return view('posts.show')->withPosts($posts);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request,$slug)
    {
        $post = Post::where('slug',$slug)->first();
        if($post && ($request->user()->id == $post->author_id || $request->user()->isAdmin()))
            return view('posts.edit')->with('post',$post);
        else
        {
            return redirect('/')->withErrors('You Have Not Sufficient Permissions');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $post_id = $request->input('post_id');
        $post = Post::find($post_id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->isAdmin()))
        {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Post::where('slug',$slug)->first();
            if($duplicate)
            {
                if($duplicate->id != $post_id)
                {
                    return redirect('edit/'.$post->slug)->withErrors('Title Already Exists.')->withInput();
                }
                else
                {
                    $post->slug = $slug;
                }
            }

            $post->title = $title;
            $post->body = $request->input('body');
            $post->slug=$slug;

                $message = 'Post updated successfully';
                $landing = $post->slug;

            $post->save();
            return redirect($landing)->withMessage($message);
        }
        else
        {
            return redirect('/')->withErrors('You have not sufficient Permissions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $post = Post::find($id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->isAdmin()))
        {
            $post->delete();
            $data['message'] = 'Post deleted Successfully';
        }
        else
        {
            $data['message'] = 'Invalid Operation. You have not sufficient permissions';
        }

        return redirect('/')->with($data);
    }


    public function postcreate()
    {

        factory('App\User', 20)->create();
        factory('App\Post', 100)->create();
        factory('App\Comment', 120)->create();

        return redirect('/')->withMessage('Success PostsCreated.');


    }
}
