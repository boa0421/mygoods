<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Auth;
use App\Post;
use Validator;

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
        $path = $request->file('item_image')->store('public/image');
        $item->item_image = basename($path);
        
        unset($form['_token']);
        unset($form['item_image']);
        
        $item->fill($form);
        $item->save();
        
        return back();
    }
    
    // public function edit($id)
    // {
    //     $item = Item::findOrFail($id);
        
    //     return view('admin.items.edit', ['item_form' => $item]);
    // }
    
    // public function update(Request $request)
    // {
    //     $this->validate($request, Item::$rules);
    //     $item = Item::find($request->id);
    //     $item_form = $request->all();
        
    //     $path = $request->file('image')->store('public/image');
    //     $item->item_image = basename($path);
    //     unset($item_form['image']);
    //     unset($item_form['_token']);
    //     $item->fill($item_form)->save();

    //     return redirect('posts/'.$post->id);
    // }
    
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        
        return back();
    }

    // public function show($id)
    // {
    //     $item = Item::findOrFail($id);
        
    //     return view('admin.items.show', ['item' => $item]);
    // }
}
