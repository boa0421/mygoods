<?php

/**
 * Users コントローラーのファイル
 * 
 * このファイルではユーザーの
 * 一覧表示の
 * 処理に関するコントローラーを書いています。
 * 
 */

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
    
}
