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
        
        $post->fill($form);
        $post->save();
        
        return redirect('admin/post/create');
    }

    public function edit()
    {
        return view('admin.post.edit');
    }

    public function update()
    {
        return redirect('admin/post/edit');
    }
    
    public function delete()
  {

      return redirect('admin/post/index');
  }  



}
