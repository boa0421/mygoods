<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use Validator;
use App\User;

class PostsController extends Controller
{
     public function index($user_id)
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id',$user_id)->get();

        return view('admin.post.index',['posts'=>$posts, 'user_id'=>$user_id]);
    }
    
    public function add()
    {
        return view('admin.post.create');
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
        
        $post->fill($post_form)->save();
        
        return redirect('admin/post/create');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        return view('admin.post.edit', ['post_form' => $post]);
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

        return redirect('admin/post/index');
    }
    
    public function delete()
  {

      return redirect('admin/post/index',['user_id'=>$user]);
  }  



}
