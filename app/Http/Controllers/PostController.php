<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function CreatePost(Request $request){
        $HTTP_RAW_POST_DATA = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $HTTP_RAW_POST_DATA['title'] = strip_tags($HTTP_RAW_POST_DATA['title']);
        $HTTP_RAW_POST_DATA['content'] = strip_tags($HTTP_RAW_POST_DATA['content']);
        $HTTP_RAW_POST_DATA['user_id'] = auth()->id();

        Post::create($HTTP_RAW_POST_DATA);

        return redirect('/');
    }

    public function DeletePost(Post $post){
        if (@auth()->user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }

    public function EditPost(Post $post){
        if (@auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function UpdatePost(Post $post, Request $request){
        if (@auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        $HTTP_RAW_POST_DATA = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $HTTP_RAW_POST_DATA['title'] = strip_tags($HTTP_RAW_POST_DATA['title']);
        $HTTP_RAW_POST_DATA['content'] = strip_tags($HTTP_RAW_POST_DATA['content']);
        $HTTP_RAW_POST_DATA['user_id'] = auth()->id();

        $post->update($HTTP_RAW_POST_DATA);
        return redirect('/');
    }
}
