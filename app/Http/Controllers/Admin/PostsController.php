<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Item;
use Auth;
use Validator;
use App\User;
use App\Tag;
use App\PostTag;

class PostsController extends Controller
{
    public function add()
    {
        $user = Auth::user();
        return view('admin.posts.create',['user'=>$user]);
    }

    public function create(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = new Post;
        $form = $request->all();
        $post->user_id = Auth::user()->id;
        $path = $request->file('image')->store('public/image');
        $post->image = basename($path);
        
        unset($form['_token']);
        unset($form['image']);
        
        $post->fill($form)->save();
        
        return redirect('posts/'.$user->id);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        
        return view('admin.posts.edit', ['post_form' => $post,'user'=>$user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request, Post::$rules);
        $post = Post::find($request->id);
        $post_form = $request->all();
        $path = $request->file('image')->store('public/image');
        $post->image = basename($path);
        unset($post_form['image']);
        
        unset($post_form['_token']);
        $post->fill($post_form)->save();
        
        return redirect('posts/'.$user->id);
    }
    
    public function delete(Request $request)
    {
        // dd($request);
        $post = Post::find($request->id);
        $post->delete();
        
        return redirect('posts/'.$user->id);
    }
}
