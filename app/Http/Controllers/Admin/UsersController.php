<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Post;

class UsersController extends Controller
{
     public function add()
    {
        return view('admin.users.create');
    }

    public function create(Request $request, $id)
    {
        return redirect('admin/posts');
    }

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
        return redirect('admin/posts');
    }
    
    // public function show()
    // {
    //     $user = User::findOrFail($id);
    //     return view('admin.users.show', ['user' => $user]);
    // }
    
    public function followings($id)
    {
        $user = User::find($id);
        // $followings = $user->followings();
        
        return view('admin.users.followings', ['user' => $user]);
    }

    public function followers($id)
    {
        $user = User::find($id);
        // $followers = $user->followers();
        
        return view('admin.users.followers', ['user' => $user]);
    }
    
    public function likes(Request $request, $id)
    {
        $user = User::find($id);
        $post = $request->post();
        
        return view('admin.users.likes', ['user' => $user, 'post' => $post]);
    }
    
    public function profile_add()
    {
        $user = Auth::user();
        return view('admin.profiles.create', ['user'=>$user]);
    }

    public function profile_create(Request $request)
    {
        $user = Auth::user();
        
        $form = $request->all();
        
        if (isset($form['image'])) {
        $path = $request->file('profile_image')->store('public/image');
        $user->profile_image = basename($path);
      } else {
          $user->profile_image = null;
      }
      
      unset($form['_token']);
      unset($form['profile_image']);
      
      $user->fill($form);
      $user->save();
        
        return redirect('admin/posts');
    }

    public function profile_edit()
    {
        $user = Auth::user();
        
        return view('admin.profiles.edit');
    }

    public function profile_update()
    {
        return redirect('admin/profiles/edit');
    }
}
