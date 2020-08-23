<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    public function add()
    {
        return view('admin.items.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Item::$rules);
        $item = new Item;
        $form = $request->all();
        $item->user_id = Auth::user()->id;
        $path = $request->file('image')->store('public/image');
        $item->item_image = basename($path);
        
        unset($form['_token']);
        unset($form['image']);
        
        $post->fill($form)->save();
        
        return redirect('admin/posts');
    }
    
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        
        return view('admin.items.edit', ['item_form' => $item]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Item::$rules);
        $item = Item::find($request->id);
        $item_form = $request->all();
        $path = $request->file('image')->store('public/image');
        $item->item_image = basename($path);
        unset($item_form['image']);

        unset($item_form['_token']);
        $item->fill($item_form)->save();

        return redirect('admin/posts');
    }
    
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        
        return redirect('admin/posts');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        
        return view('admin/items.show', ['item' => $item]);
    }
}
