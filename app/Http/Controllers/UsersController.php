<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserFollow;

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
        
        $user->loadRelationshipCounts();
        
        $followings = $user->followings()->paginate(10);
        
        return view('users.followings', ['user' => $user,'users' => $followings,]);
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $followers = $user->followers()->paginate(10);
        
        return view('users.followers', ['user' => $user, 'users' => $followers,]);
    }
}
