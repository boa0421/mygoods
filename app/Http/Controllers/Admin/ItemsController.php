<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Auth;
use App\Post;
use Validator;
use Storage;

class ItemsController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->post_id);
        // dd($post_id);
        return view('admin.items.create', ['post_id' => $request->post_id]);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Item::$rules);
        $post = Post::find($request->post_id);
        $item = new Item;
        $form = $request->all();
        $item->post_id = $request->post_id;
        // $path = $request->file('item_image')->store('public/image');
        $path = Storage::disk('s3')->putFile('/',$form['item_image'],'public');
        // $item->item_image = basename($path);
        $item->item_image = Storage::disk('s3')->url($path);
        
        unset($form['_token']);
        unset($form['item_image']);
        
        $item->fill($form);
        $item->save();
        
        return back();
    }
    
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        
        return back();
    }

}
