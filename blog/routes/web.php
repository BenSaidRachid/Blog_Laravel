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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Auth::routes();

Route::group(['middleware' => 'status'], function () { 
	Route::get('/post', 'PostsController@index');
	Route::post('/post', 'PostsController@store');
	Route::get('/post/new', 'PostsController@create');
	Route::get('/post/{id}', 'PostsController@show');
	Route::get('/post/{id}/delete', 'PostsController@delete');
	Route::post('/post/{id}/update', 'PostsController@update');
	Route::get('/post/{id}/edit', 'PostsController@edit');
	Route::post('/post/{id}/comments', 'CommentController@store');
	Route::post('/comment/{id}/update', 'CommentController@update');
	Route::get('/comment/{id}/edit', 'CommentController@edit');
	Route::get('/comment/{id}/delete', 'CommentController@delete');
	Route::get('/profil/{id}', 'HomeController@show');
	Route::get('/profil/{id}/delete', 'HomeController@delete');
	Route::get('/profil/{id}/edit', 'HomeController@edit');
	Route::post('/profil/{id}/update', 'HomeController@update');
});

Route::group(['middleware' => 'admin'], function () {     
    Route::get('/admin', 'AdminController@index');
	Route::get('/admin/users', 'AdminController@users');
	Route::get('/admin/posts', 'AdminController@posts');
	Route::get('/admin/{id}/', 'AdminController@show');
	Route::get('/admin/{id}/block', 'AdminController@block');
	Route::get('/admin/{id}/delete', 'AdminController@delete');
	Route::get('/admin/{id}/edit', 'AdminController@edit');
	Route::post('/admin/{id}/update', 'AdminController@update');
});


