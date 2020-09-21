<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\PostTag;

class TagsController extends Controller
{
    public function index(Request $request, $id)
    {
        $tag = Tag::find($id);
        $posts = $tag->posts()->get();
        
        return view('tags.index',['posts'=>$posts, 'tag'=>$tag]);
    }
}
