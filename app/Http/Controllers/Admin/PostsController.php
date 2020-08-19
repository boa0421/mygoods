<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
     public function index()
    {
        return view('admin.post.index');
    }
    public function add()
    {
        return view('admin.post.create');
    }

    public function create()
    {
        return redirect('admin/post/create');
    }

    public function edit()
    {
        return view('admin.post.edit');
    }

    public function update()
    {
        return redirect('admin/post/edit');
    }
    
    public function delete()
  {

      return redirect('admin/post/index');
  }  



}
