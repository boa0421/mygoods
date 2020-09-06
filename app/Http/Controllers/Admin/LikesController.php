<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Like;
use App\Post;
use Auth;
use Validator;

class LikesController extends Controller
{
    public function create(Request $request, $id)
    {
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;
        $like->save();
        
        return redirect('admin/posts');
    }
    
    public function delete(Request $request, $id)
    {
        $like = Like::find($request->like_id);
        $like->delete();
        
        return redirect('admin/posts');
    }

}
