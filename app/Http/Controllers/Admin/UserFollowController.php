<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserFollowController extends Controller
{
     public function create($id)
    {
        \Auth::user()->follow($id);
        return redirect('posts/'.$user->id);
    }
    
    public function delete($id)
    {
        \Auth::user()->unfollow($id);
        return redirect('posts/'.$user->id);
    }
}
