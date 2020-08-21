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
Route::get('post/show', 'PostsController@show');

Route::group(['prefix' => 'admin'], function() {
     Route::get('post/create', 'Admin\PostsController@add')->middleware('auth');
     Route::post('post/create', 'Admin\PostsController@create')->middleware('auth');
     // Route::get('post/index', 'Admin\PostsController@index');
     Route::get('post/edit', 'Admin\PostsController@edit')->middleware('auth');
     Route::post('post/edit', 'Admin\PostsController@update')->middleware('auth');
     Route::get('post/delete', 'Admin\PostsController@delete')->middleware('auth');
});
Auth::routes();

Route::get('admin/post/{user_id}', 'Admin\PostsController@index');

Route::get('/home', 'HomeController@index')->name('home');
