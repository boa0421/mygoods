<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all()->sortByDesc('updated_at');
        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        
        return view('posts.index', ['headline' => $headline, 'posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        return view('posts.show', ['post' => $post]);
    }

}
