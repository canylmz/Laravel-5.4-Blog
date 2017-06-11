<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' =>'required|unique:posts|min:3|max:255',
            'body' =>'required|min:2',
        ];
    }

    public function PostSave(){


        $post = new Post();
        $post->title = request()->get('title');
        $post->body = request()->get('body');
        $post->slug = str_slug($post->title);

        $duplicate = Post::where('slug',$post->slug)->first();
        if($duplicate)
        {
            return redirect('new-post')->withErrors('Title already exists.')->withInput();
        }
        $post->author_id = request()->user()->id;
        $post->save();

    }
}
