<?php

/**
 * Tags コントローラーのファイル
 * 
 * このファイルではタグに紐付けられたポストの
 * 一覧表示
 * 処理に関するコントローラーを書いています。
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\PostTag;
use Auth;

class TagsController extends Controller
{
    /**
     * タグに紐付けられたポストの一覧表示
     *  
     * @param int $id タグid
     */
    public function index(Request $request, $id)
    {
        $tag = Tag::find($id);
        $user = Auth::user();
        $posts = $tag->posts()->get();
        
        return view('tags.index',['posts'=>$posts, 'tag'=>$tag, 'user'=>$user]);
    }
}
