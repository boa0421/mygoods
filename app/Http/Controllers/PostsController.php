<?php

/**
 * Postsコントローラーのファイル
 * 
 * このファイルではpostsの
 * 一覧表示、詳細表示
 * トップページ表示、aboutページ表示の
 * 処理に関するコントローラーを書いています。
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;
use Auth;
use App\Item;
use Validator;

class PostsController extends Controller
{
    /**
     * ポスト一覧表示
     *  
     * @param int $id ユーザーid
     * 
     */
    public function index(Request $request, $id)
    {
        $user = User::find($id);
        $posts = Post::where('user_id',$id)->paginate(12);
        
        return view('posts.index',['posts'=>$posts, 'user'=>$user]);
    }
    
    /**
     * ポスト詳細表示
     *  
     * @param int $id ユーザーid
     * 
     */
    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = User::find($post->user_id);
        
        return view('posts.show', ['post'=>$post, 'user'=>$user, 'post_id' => $post->id]);
    }
    
    public function top(Request $request)
    {
        $posts = Post::paginate(6);
        $users = User::orderBy('created_at','Desc')->take(3)->get();
        $tags = Tag::orderBy('created_at','Desc')->take(3)->get();
        
        return view('posts.top',['posts'=>$posts, 'users'=>$users, 'tags'=>$tags]);
    }
    
    public function about()
    {
        return view('about');
    }

}
