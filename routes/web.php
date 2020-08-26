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

Route::get('/', 'PostsController@index');
Route::get('posts/{id}/show', 'PostsController@show');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('posts/create', 'Admin\PostsController@add');
     Route::post('posts/create', 'Admin\PostsController@create');
     Route::get('posts', 'Admin\PostsController@index');
     Route::get('posts/{id}/show', 'Admin\PostsController@show');
     Route::get('posts/{id}/edit', 'Admin\PostsController@edit');
     Route::post('posts/edit', 'Admin\PostsController@update');
     Route::get('posts/delete', 'Admin\PostsController@delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('users/create', 'Admin\UsersController@add');
     Route::post('users/{id}/create', 'Admin\UsersController@create');
     Route::get('users', 'Admin\UsersController@index');
     Route::get('users/{id}/show', 'Admin\UsersController@show');
     Route::get('users/edit', 'Admin\UsersController@edit');
     Route::post('users/edit', 'Admin\UsersController@update');
     Route::get('users/delete', 'Admin\UsersController@delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('items/create', 'Admin\ItemsController@add');
     Route::post('items/create', 'Admin\ItemsController@create');
     Route::get('items/{id}/show', 'Admin\ItemsController@show');
     Route::get('items/{id}/delete', 'Admin\ItemsController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
