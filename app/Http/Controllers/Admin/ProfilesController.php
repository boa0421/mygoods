<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class ProfilesController extends Controller
{
     public function index()
    {
        return view('admin.profile.index');
    }
    
     public function add($user_id)
    {
        $user_id = Auth::user()->id;
        return view('admin.profile.create');
    }

    public function create(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        
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

    public function edit()
    {
        $user_id = Auth::user()->id;
        
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
}
