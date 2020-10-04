<?php

/**
 * admin/items コントローラーのファイル
 * 
 * このファイルではitemsの
 * 新規作成フォーム表示、保存、削除の
 * 処理に関するコントローラーを書いています。
 * 'middleware' => 'auth'
 * 
 */

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
        return view('admin.items.create', ['post_id' => $request->post_id]);
    }
    
    public function create(Request $request)
    {
        // バリデーション 投稿必須項目:id,post_id,item_name,item_image,
        $this->validate($request, Item::$rules);
        
        $post = Post::find($request->post_id);
        $item = new Item;
        $form = $request->all();
        $item->post_id = $request->post_id;
        
        // imageをpublic/imageに保存するとき
        // $path = $request->file('item_image')->store('public/image');
        // $item->item_image = basename($path);
        
        // imageをs3に保存
        $path = Storage::disk('s3')->putFile('/',$form['item_image'],'public');
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
