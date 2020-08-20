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
     Route::get('post/create', 'Admin\PostsController@add');
     Route::post('post/create', 'Admin\PostsController@create');
     Route::get('post/index', 'Admin\PostsController@index');
     Route::get('post/edit', 'Admin\PostsController@edit');
     Route::post('post/edit', 'Admin\PostsController@update');
     Route::get('post/delete', 'Admin\PostsController@delete');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
