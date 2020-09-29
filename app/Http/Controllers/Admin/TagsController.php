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
            
        return back();
    }
    
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        
        return back();
    }
    
}
