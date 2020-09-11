<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;

class PostsController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::find($id);

        $posts = Post::where('user_id',$id)->get();
        
        return view('posts.index',['posts'=>$posts,'user'=>$user]);
    }

    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = User::find($post->user_id);

        return view('posts.show', ['post' => $post, 'user' => $user]);
    }
    
    public function top(Request $request)
    {
        $posts = Post::all();
        
        return view('posts.top',['posts'=>$posts]);
    }

}
