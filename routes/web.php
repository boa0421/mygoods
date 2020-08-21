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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
