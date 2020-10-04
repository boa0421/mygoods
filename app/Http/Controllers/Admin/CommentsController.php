<?php

/**
 * admin/comments コントローラーのファイル
 * 
 * このファイルではcommentsの
 * 新規作成、削除の
 * 処理に関するコントローラーを書いています。
 * 'middleware' => 'auth'
 * 
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;
use Auth;
use Validator;

class CommentsController extends Controller
{
    public function create(Request $request, $id)
    {
        // バリデーション 必須項目:id,user_id,post_id,comment,timestamps
        $this->validate($request, Comment::$rules);
        
        $post = $request->post($id);
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        
        return redirect()->route('posts.show', ['id' => $id]);
    }
    
    public function delete(Request $request, $id)
    {
        $comment = Comment::find($request->id);
        $comment->delete();
        
        return back();
    }
}
