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
        
        $post_tag = new PostTag;
        if ( Tag::where("tag_name", $request->tag_name)->exists() ){
            $tag = Tag::where("tag_name", $request->tag_name)->first();
        }else{
            $tag = new Tag();
            $tag->tag_name = $request->tag_name;
            $tag->save();
        }
        $post->tags()->attach(
                    ['post_id' => $post->id],
                    ['tag_id' => $tag->id]
            );

        // $tag = new Tag;
        // $form = $request->all();
        // $post_id = Post::find($request->id);
        // $tag->post_tags()->attach($post_id);
                
        // unset($form['_token']);
        
        // $tag->fill($form);
        // $tag->save();
        
        // return redirect('admin/posts/show', ['id' => $post]);
        return back();
    }
    
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        
        return redirect('admin/posts');
    }
    
}
