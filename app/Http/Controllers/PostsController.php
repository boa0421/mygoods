<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();
        
        return view('posts.index',['posts'=>$posts]);
    }

    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = User::find($post->user_id);
        
        return view('posts.show', ['post' => $post, 'user' => $user]);
    }

}
