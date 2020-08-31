<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostTag;
use App\Post;
use App\Tag;

class PostTagsController extends Controller
{
    // public function create(Request $request)
    // {
    //     $post_tag = new PostTag;
    //     $post_tag->post_id = $request->post_id;
    //     $post_tag->tag_id = $request->tag_id;
    //     $form = $request->all();
    //     $post_tag->fill($form);
    //     $post_tag->save();
        
    //     return redirect('admin/posts');
    // }
    
    // public function destroy(Request $request)
    // {
    //     $post_tag = PostTag::find($request->post_tag_id);
    //     $post_tag->delete();
    //     return redirect()->back();
    // }
 
}
