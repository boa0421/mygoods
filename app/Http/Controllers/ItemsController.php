<?php

/**
 * Items コントローラーのファイル
 * 
 * このファイルではアイテムの
 * 一覧表示
 * 処理に関するコントローラーを書いています。
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Post;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::paginate(4);
        
        // アイテム検索機能
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $items = Item::where('item_name', $cond_title)->paginate(4);
        } else {
            "検索結果はありませんでした";
        }
        
        return view('items.index', ['items' => $items, 'cond_title' => $cond_title]);
    }
    
}
