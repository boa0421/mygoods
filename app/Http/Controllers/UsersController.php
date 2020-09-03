<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all()->sortByDesc('updated_at');
        
        return view('users.index', ['users' => $users]);
    }
    
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        return view('users.show', ['user' => $user]);
    }
    
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings();
        
        return view('users.followings', ['user' => $user,'users' => $followings,]);
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers();
        
        return view('users.followers', ['user' => $user, 'users' => $followers,]);
    }
}
