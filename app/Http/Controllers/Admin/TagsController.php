<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Tag;
use App\Post;
use App\PostTag;
use Validator;

class TagsController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user();
        return view('admin.tags.create', ['post_id' => $request->post_id, 'user' => $user]);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Tag::$rules);
        $post = Post::find($request->post_id);
        $tag = new Tag();
        $tag->fill($request->all())->save();
        $post->tags()->attach($tags->id);
        // $tag = new Tag;
        // $form = $request->all();
        // $post_id = Post::find($request->id);
        // $tag->post_tags()->attach($post_id);
                
        // unset($form['_token']);
        
        // $tag->fill($form);
        // $tag->save();
        
        return redirect('admin/posts');
    }
    
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        
        return redirect()->back();
    }
    
}
