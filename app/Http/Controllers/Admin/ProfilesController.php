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
        return view('admin.profiles.index');
    }
    
    public function add()
    {
        $user = Auth::user();
        return view('admin.profiles.create', ['user'=>$user]);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        
        $form = $request->all();
        
        if (isset($form['image'])) {
        // $path = $request->file('profile_image')->store('public/image');
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
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

    public function edit()
    {
        $user = Auth::user();
        
        return view('admin.profiles.edit');
    }

    public function update()
    {
        return redirect('admin/profiles/edit');
    }
}
