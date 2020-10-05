<?php

/**
 * Admin/Users コントローラーのファイル
 * 
 * このファイルではユーザーの
 * 編集フォーム表示、編集、削除の
 * 処理に関するコントローラーを書いています。
 * 'middleware' => 'auth'
 * 
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Post;
use App\Like;
use App\Interest;
use Storage;
use Validator;

class UsersController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // 変数定義
        $user = User::find($request->id);
        $user->name = $request->user_name;
        // $user->password = $request->user_password;
        // $user->password = bcrypt($request->user_password);
        
        $form = $request->all();
        
        // profile_imageを上書きするとき
        // profile_imageの投稿があれば保存、なければnull
        // if (isset($form['image'])) {
            
            // imageをpublic/imageに保存するとき
            // $path = $request->file('image')->store('public/image');
            // $user->profile_image = basename($path);
            
            // imageをs3に保存
        //     $path = Storage::disk('s3')->putFile('/',$form['profile_image'],'public');
        //     $user->profile_image = Storage::disk('s3')->url($path);
            
        // } else {
        //     $user->profile_image = null;
        // }
      
        unset($form['_token']);
        // unset($form['image']);
      
        $user->fill($form);
        $user->save();
        
        return redirect('posts/'.$user->id);
    }
    
    public function delete(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        
        return redirect('/');
    }
    
    /**
     * フォローしているユーザーの一覧表示
     *  
     * @param int $id ユーザーid
     */
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings();
        
        return view('admin.users.followings', ['user' => $user, 'followings' => $followings]);
    }
    
    /**
     * フォローされているユーザーの一覧表示
     *  
     * @param int $id ユーザーid
     */
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers();
        
        return view('admin.users.followers', ['user' => $user, 'followers' => $followers]);
    }
    
    /**
     * いいねした投稿の一覧表示
     *  
     * @param int $id ユーザーid
     */
    public function likes(Request $request, $id)
    {
        $user = User::find($id);
        $post = $request->post();
        $likes = $user->likes();
        
        return view('admin.users.likes', ['user' => $user, 'post' => $post, 'likes' => $likes]);
    }
    
    /**
     * プロフィール編集フォーム表示※アカウントではない
     *  
     */
    public function profile_add()
    {
        $user = Auth::user();
        
        return view('admin.profiles.create', ['user'=>$user]);
    }
    
    /**
     * プロフィール保存
     *  
     */
    public function profile_create(Request $request)
    {
        $user = Auth::user();
        
        // 趣味投稿
        // $interest_user = new Interest;
        // if ( Interest::where("interest", $request->interest)->exists() ){
        //     $interest = Interest::where("interest", $request->interest)->first();
        // }else{
        //     $interest = new Interest();
        //     $interest->interest = $request->interest;
        //     $interest->save();
        // }
        // $user->interests()->attach(
        //             ['user_id' => $user->id],
        //             ['interest_id' => $interest->id]
        //     );
        
        $form = $request->all();
        
        // profile_imageを上書きするとき
        // profile_imageの投稿があれば保存、なければnull
        if (isset($form['profile_image'])) {
            // imageをpublic/imageに保存するとき
            // $path = $request->file('profile_image')->store('public/image');
            // $user->profile_image = basename($path);
            
            // imageをs3に保存
            $path = Storage::disk('s3')->putFile('/',$form['profile_image'],'public');
            $user->profile_image = Storage::disk('s3')->url($path);
        } else {
            $user->profile_image = null;
        }
      
        unset($form['_token']);
        unset($form['profile_image']);

        $user->fill($form);
        $user->save();
        
        return redirect('posts/'.$user->id);
        
    }
}
