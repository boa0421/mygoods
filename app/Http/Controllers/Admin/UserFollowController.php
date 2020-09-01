<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFollowController extends Controller
{
     public function create($id)
    {
        \Auth::user()->follow($id);
        return redirect('admin/posts');
    }
    
    public function delete($id)
    {
        \Auth::user()->unfollow($id);
        return redirect('admin/posts');
    }
}
