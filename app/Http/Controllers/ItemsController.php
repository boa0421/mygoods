<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all()->sortByDesc('updated_at');
        
        return view('items.index', ['items' => $items]);
    }
    
}
