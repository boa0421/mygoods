<?php

/**
 * admin/tags コントローラーのファイル
 * 
 * このファイルではtagsの
 * 新規作成フォーム表示、保存、削除の
 * 処理に関するコントローラーを書いています。
 * 'middleware' => 'auth'
 * 
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Tag;
use App\Post;
use App\PostTag;
use Validator;

class TagsController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user();
        return view('admin.tags.create', ['post_id' => $request->post_id, 'user' => $user]);
    }
    
    public function create(Request $request)
    {
        // バリデーション 投稿必須項目:id,tag_name,timestamps
        $this->validate($request, Tag::$rules);
        
        // 変数定義
        $post = Post::find($request->post_id);
        $post_tag = new PostTag;
        
        // tags_tableのtag_nameカラムに投稿されたtag_nameと同じ値があればそのidを中間テーブルに保存
        // なければ投稿されたtag_nameをtags_tableに保存 そのidを中間テーブルにも保存
        if ( Tag::where("tag_name", $request->tag_name)->exists() ){
            $tag = Tag::where("tag_name", $request->tag_name)->first();
        }else{
            $tag = new Tag();
            $tag->tag_name = $request->tag_name;
            $tag->save();
        }
        $post->tags()->attach(
                    ['post_id' => $post->id],
                    ['tag_id' => $tag->id]
            );
            
        return back();
    }
    
    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        
        return back();
    }
    
}
