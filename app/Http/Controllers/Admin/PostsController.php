<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Item;
use App\User;
use App\Tag;
use App\PostTag;
use Auth;
use Validator;
use Storage;

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
        $user = Auth::user();
        $post = new Post;
        $form = $request->all();
        $post->user_id = Auth::user()->id;
        // $path = $request->file('image')->store('public/image');
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        // $post->image = basename($path);
        $post->image = Storage::disk('s3')->url($path);
        
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
        // $path = $request->file('image')->store('public/image');
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        // $post->image = basename($path);
        $post->image = Storage::disk('s3')->url($path);
        unset($post_form['image']);
        
        unset($post_form['_token']);
        $post->fill($post_form)->save();
        
        return redirect('posts/'.$user);
    }
    
    public function delete(Request $request)
    {
        $user = Auth::user();
        $post = Post::find($request->id);
        $post->delete();
        
        return redirect('posts/'.$user->id);
    }
    
}
