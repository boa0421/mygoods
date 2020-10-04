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


Route::get('/', 'PostsController@top');
Route::get('about', 'PostsController@about');

Route::group(['prefix' => 'posts'], function () {
     Route::get('{id}', 'PostsController@index');
     Route::get('{id}/show', 'PostsController@show')->name('posts.show');
});

Route::get('users/index', 'UsersController@index');

Route::get('items/index', 'ItemsController@index');

Route::get('tags/{id}', 'TagsController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     
     // ポスト
     Route::group(['prefix' => 'posts'], function () {
          Route::get('create', 'Admin\PostsController@add');
          Route::post('create', 'Admin\PostsController@create');
          Route::get('{id}/show', 'Admin\PostsController@show')->name('admin.posts.show');
          Route::get('{id}/edit', 'Admin\PostsController@edit');
          Route::post('edit', 'Admin\PostsController@update');
          Route::get('delete', 'Admin\PostsController@delete');
     });
     
     // ユーザー
     Route::group(['prefix' => 'users'], function () {
          Route::get('create', 'Admin\UsersController@add');
          Route::post('{id}/create', 'Admin\UsersController@create');
          Route::get('edit', 'Admin\UsersController@edit');
          Route::post('edit', 'Admin\UsersController@update');
          Route::get('delete', 'Admin\UsersController@delete');
     });
     
     // コメント
     Route::post('comments/{id}','Admin\CommentsController@create');
     Route::get('comments/{id}', 'Admin\CommentsController@delete');
     
     // アイテム
     Route::group(['prefix' => 'items'], function () {
          Route::get('create', 'Admin\ItemsController@add');
          Route::post('create', 'Admin\ItemsController@create');
          Route::get('{id}/show', 'Admin\ItemsController@show');
          Route::get('{id}/delete', 'Admin\ItemsController@delete');
     });
     
     // タグ
     Route::group(['prefix' => 'tags'], function () {
          Route::get('create', 'Admin\TagsController@add');
          Route::post('create', 'Admin\TagsController@create');
          Route::get('delete', 'Admin\TagsController@delete');
     });
     
     // プロフィール
     Route::group(['prefix' => 'profiles'], function () {
          Route::get('create', 'Admin\UsersController@profile_add');
          Route::post('create', 'Admin\UsersController@profile_create');
          Route::get('delete', 'Admin\UsersController@profile_delete');
     });
     
     // いいね機能
     Route::group(['prefix'=>'posts/{id}'],function(){
          Route::match(['get', 'post'],'like','Admin\LikesController@create')->name('likes.like');
          Route::match(['get', 'post'],'unlike','Admin\LikesController@delete')->name('likes.unlike');
    });
    Route::get('users/{id}/likes', 'Admin\UsersController@likes')->name('admin.users.likes');
    
     // フォロー機能
     Route::group(['prefix' => 'users/{id}'], function () {
          Route::match(['get', 'post'],'follow', 'Admin\UserFollowController@create');
          Route::match(['get', 'post'],'unfollow', 'Admin\UserFollowController@delete');
          Route::get('followings', 'Admin\UsersController@followings')->name('admin.users.followings');
          Route::get('followers', 'Admin\UsersController@followers')->name('admin.users.followers');
    });
    
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
