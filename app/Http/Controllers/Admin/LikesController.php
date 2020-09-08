<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Like;
use App\Post;
use Auth;
use User;

class LikesController extends Controller
{
    public function create(Request $request, $id)
    {
        \Auth::user()->like($id);
        return back();
    }

    public function delete($id)
    {
        \Auth::user()->unlike($id);
        return back();
    }

}
