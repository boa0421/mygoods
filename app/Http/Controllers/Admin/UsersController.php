<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Post;
use App\Like;
use App\Interest;

class UsersController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->user_name;
        $user->password = bcrypt($request->user_password);
        
        $form = $request->all();
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $user->profile_image = basename($path);
        } else {
            $user->profile_image = null;
        }
      
        unset($form['_token']);
        unset($form['image']);
      
        $user->fill($form);
        $user->save();
        return redirect('posts/'.$user->id);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(1);
        
        return view('admin.users.followings', ['user' => $user, 'followings' => $followings]);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(1);
        
        return view('admin.users.followers', ['user' => $user, 'followers' => $followers]);
    }
    
    public function likes(Request $request, $id)
    {
        $user = User::find($id);
        $post = $request->post();
        $likes = $user->likes()->paginate(1);
        
        return view('admin.users.likes', ['user' => $user, 'post' => $post, 'likes' => $likes]);
    }
    
    public function profile_add()
    {
        $user = Auth::user();
        return view('admin.profiles.create', ['user'=>$user]);
    }

    public function profile_create(Request $request)
    {
        $user = Auth::user();
        
        $interest_user = new Interest;
        if ( Interest::where("interest", $request->interest)->exists() ){
            $interest = Interest::where("interest", $request->interest)->first();
        }else{
            $interest = new Interest();
            $interest->interest = $request->interest;
            $interest->save();
        }
        $user->interests()->attach(
                    ['user_id' => $user->id],
                    ['interest_id' => $interest->id]
            );
        
        $form = $request->all();
        if (isset($form['profile_image'])) {
            $path = $request->file('profile_image')->store('public/image');
            $user->profile_image = basename($path);
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
