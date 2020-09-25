<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(4);
        
        return view('users.index', ['users' => $users]);
    }
    
    // public function followings($id)
    // {
    //     $user = User::findOrFail($id);
    //     $followings = $user->followings();
        
    //     return view('users.followings', ['user' => $user,'users' => $followings,]);
    // }

    // public function followers($id)
    // {
    //     $user = $request->user();
    //     $followers = $user->followers();
        
    //     return view('users.followers', ['user' => $user, 'users' => $followers,]);
    // }
}
