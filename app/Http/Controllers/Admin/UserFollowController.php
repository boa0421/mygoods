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
        return back();
    }
    
    public function delete($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
