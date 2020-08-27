<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function add(Request $request)
    {
        return view('admin.tags.create', ['post_id' => $request->post_id]);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Item::$rules);
        $tag = new Tag;
        $form = $request->all();
        $tag->post_id = $request->post_id;
        
        unset($form['_token']);
        
        $tag->fill($form);
        $tag->save();
        
        return redirect('admin/posts');
    }
    
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        
        return redirect('admin/posts');
    }
    
}
