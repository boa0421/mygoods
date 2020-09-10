<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PostsController@top');
Route::get('posts/{id}', 'PostsController@index');
Route::get('posts/{id}/show', 'PostsController@show')->name('posts.show');
Route::get('users/{id}/show', 'UsersController@show');
Route::get('users/index', 'UsersController@index');
Route::get('admin/users/{id}/followings', 'Admin\UsersController@followings')->name('admin.users.followings');
Route::get('admin/users/{id}/followers', 'Admin\UsersController@followers')->name('admin.users.followers');
Route::get('admin/users/{id}/likes', 'Admin\UsersController@likes')->name('admin.users.likes');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     
     // ポスト
     Route::get('posts/create', 'Admin\PostsController@add');
     Route::post('posts/create', 'Admin\PostsController@create');
     // Route::get('posts', 'Admin\PostsController@index');
     Route::get('posts/{id}/show', 'Admin\PostsController@show')->name('admin.posts.show');
     Route::get('posts/{id}/edit', 'Admin\PostsController@edit');
     Route::post('posts/edit', 'Admin\PostsController@update');
     Route::get('posts/delete', 'Admin\PostsController@delete');
     
     // ユーザー
     Route::get('users/create', 'Admin\UsersController@add');
     Route::post('users/{id}/create', 'Admin\UsersController@create');
     Route::get('users', 'Admin\UsersController@index');
     Route::get('users/{id}/show', 'Admin\UsersController@show')->name('admin.user.show');
     Route::get('users/edit', 'Admin\UsersController@edit');
     Route::post('users/edit', 'Admin\UsersController@update');
     Route::get('users/delete', 'Admin\UsersController@delete');
     
     // コメント
     Route::post('comments/{id}','Admin\CommentsController@create');
     Route::get('comments/{id}', 'Admin\CommentsController@delete');
     
     // アイテム
     Route::get('items/create', 'Admin\ItemsController@add');
     Route::post('items/create', 'Admin\ItemsController@create');
     Route::get('items/{id}/show', 'Admin\ItemsController@show');
     Route::get('items/{id}/delete', 'Admin\ItemsController@delete');
     
     // タグ
     Route::get('tags/create', 'Admin\TagsController@add');
     Route::post('tags/create', 'Admin\TagsController@create');
     Route::get('tags/delete', 'Admin\TagsController@delete');
     
     // プロフィール
     Route::get('profiles/create', 'Admin\UsersController@profile_add');
     Route::post('profiles/create', 'Admin\UsersController@profile_create');
     Route::get('psrofiles/delete', 'Admin\UsersController@profile_delete');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
     Route::group(['prefix' => 'users/{id}'], function () {
        Route::match(['get', 'post'],'follow', 'Admin\UserFollowController@create');
        Route::match(['get', 'post'],'unfollow', 'Admin\UserFollowController@delete');
    });
});

Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'posts/{id}'],function(){
       Route::match(['get', 'post'],'like','Admin\LikesController@create')->name('likes.like');
       Route::match(['get', 'post'],'unlike','Admin\LikesController@delete')->name('likes.unlike');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
