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
    public function index(Request $request)
    {
        $user = User::find($request->user_id);
        $user_id = $user->id;
        $posts = Post::where('user_id',$user_id)->get();
        
        return view('admin.posts.index',['posts'=>$posts,'user'=>$user]);
    }
    
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
        
        return redirect('admin/posts');
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
        
        return redirect('admin/posts');
    }
    
    public function delete(Request $request)
    {
        // dd($request);
        $post = Post::find($request->id);
        $post->delete();
        
        return redirect('admin/posts');
    }

    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        // $user = User::find($request->id);
        // dd($post);
        // $post_id = $request->post_id;
        // dd($post->image);
        // $items = Item::where('post_id',$id)->get();
        // dd(Item::where('post_id',$post_id));
        // $item->item_name = $request->item_name;
        // $post->item_id = $request->item_id;
        // dd($items);
        // dd($post_id);
        
        return view('admin.posts.show', ['post' => $post, 'user' => $user]);
    }
}
