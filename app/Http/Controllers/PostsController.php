<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;
use Auth;

class PostsController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::find($id);

        $posts = Post::where('user_id',$id)->paginate(12);
        
        return view('posts.index',['posts'=>$posts, 'user'=>$user]);
    }

    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = User::find($post->user_id);
        
        return view('posts.show', ['post'=>$post, 'user'=>$user]);
    }
    
    public function top(Request $request)
    {
        $posts = Post::paginate(6);
        $users = User::all()->sortByDesc('created_at');
        $tags = Tag::all()->sortByDesc('created_at');
        
        return view('posts.top',['posts'=>$posts, 'users'=>$users, 'tags'=>$tags]);
    }

}
