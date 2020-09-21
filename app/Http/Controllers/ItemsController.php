<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::paginate(4);
        
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $items = Item::where('item_name', $cond_title)->paginate(4);
        } else {
            "検索結果はありませんでした";
        }
        
        return view('items.index', ['items' => $items, 'cond_title' => $cond_title]);
    }
    
}
