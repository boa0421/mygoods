<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Item;
use Auth;
use Validator;
use App\User;

class PostsController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id',$user_id)->get();

        return view('admin.posts.index',['posts'=>$posts]);
    }
    
    public function add()
    {
        return view('admin.posts.create');
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
        
        return redirect('admin/posts');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        return view('admin.posts.edit', ['post_form' => $post]);
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
        
        return redirect('admin/posts');
    }
    
    public function delete(Request $request)
    {
        // dd($request);
        $post = Post::find($request->id);
        $post->delete();
        
        return redirect('admin/posts');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        // dd($post);
        // $post_id = $request->post_id;
        // dd($post->image);
        // $items = Item::where('post_id',$id)->get();
        // dd(Item::where('post_id',$post_id));
        // $item->item_name = $request->item_name;
        // $post->item_id = $request->item_id;
        // dd($items);
        // dd($post_id);
        
        return view('admin.posts.show', ['post' => $post]);
    }
}
