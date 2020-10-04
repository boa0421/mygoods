<?php

/**
 * admin/posts コントローラーのファイル
 * 
 * このファイルではpostsの
 * 新規作成フォーム表示、保存、編集フォーム表示、編集、削除の
 * 処理に関するコントローラーを書いています。
 * 'middleware' => 'auth'
 * 
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use App\User;

use Validator;
use Storage;

use App\Item;
use App\Tag;
use App\PostTag;


class PostsController extends Controller
{
    public function add()
    {
        $user = Auth::user();
        
        return view('admin.posts.create',['user'=>$user]);
    }
    

    public function create(Request $request)
    {
        // バリデーション 投稿必須項目:id,user_id,title,image
        $this->validate($request, Post::$rules);
        
        // post保存 変数定義
        $user = Auth::user();
        $post = new Post;
        $form = $request->all();
        $post->user_id = Auth::user()->id;
        
        // imageをpublic/imageに保存するとき
        // $path = $request->file('image')->store('public/image');
        // $post->image = basename($path);
        
        // imageをs3に保存
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $post->image = Storage::disk('s3')->url($path);
        
        unset($form['_token']);
        unset($form['image']);
        
        $post->fill($form)->save();
        
        return redirect('posts/'.$user->id);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        
        return view('admin.posts.edit', ['post_form' => $post,'user'=>$user]);
    }

    public function update(Request $request)
    {
        // バリデーション 投稿必須項目:id,user_id,title,image
        $this->validate($request, Post::$rules);
        
        // post編集 変数定義
        $user = Auth::user()->id;
        $post = Post::find($request->id);
        $post_form = $request->all();
        
        // imageをpublic/imageに保存するとき
        // $path = $request->file('image')->store('public/image');
        // $post->image = basename($path);
        
        // imageをs3に保存
        $path = Storage::disk('s3')->putFile('/',$post_form['image'],'public');
        $post->image = Storage::disk('s3')->url($path);
        
        unset($post_form['image']);
        unset($post_form['_token']);
        
        $post->fill($post_form)->save();
        
        return redirect('posts/'.$user);
    }
    
    public function delete(Request $request)
    {
        $user = Auth::user();
        $post = Post::find($request->id);
        $post->delete();
        
        return redirect('posts/'.$user->id);
    }
    
}
