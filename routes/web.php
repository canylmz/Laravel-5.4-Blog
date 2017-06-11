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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//----------------------------Users---------------------------------------------------------------------------

Route::get ('/user/{id}/posts',                ['middleware' => 'auth', 'uses'=> 'UserController@user_posts'])->where('id','[0-9]+');
Route::get ('/my-all-posts',                   ['middleware' => 'auth', 'uses'=> 'UserController@user_posts_all']);
Route::get ('/profile/{id?}',                  ['middleware' => 'auth', 'uses'=> 'UserController@profile']);


//--------------------------------------------------------------------------------------------------------------


//-----------------------------POST----------------------------------------------------------------------------
Route::get ('/new-post',                        ['middleware' => 'auth', 'uses'=> 'PostController@create']);
Route::post('/new-post',                        ['middleware' => 'auth', 'uses'=> 'PostController@store']);
Route::get ('/edit/{slug}',                     ['middleware' => 'auth', 'uses'=> 'PostController@edit']);
Route::post('/update',                          ['middleware' => 'auth', 'uses'=> 'PostController@update']);
Route::get ('/delete/{id}',                     ['middleware' => 'auth', 'uses'=> 'PostController@destroy']);
Route::get ('/postcreate',                     ['middleware' => 'auth', 'uses'=> 'PostController@postcreate']);

//--------------------------------------------------------------------------------------------------------------


//--------------------------------------------------------------------------------------------------------------
Route::get ('/',                                ['middleware' => 'auth', 'uses'=> 'PostController@index']);
Route::get('/{slug}',                           ['middleware' => 'auth', 'uses'=> 'PostController@show'])->where('slug','[A-Za-z0-9\-]+');


//--------------------------------------------------------------------------------------------------------------


//----------------------------Comment---------------------------------------------------------------------------

Route::post ('/posts/{post}/comments',            ['middleware' => 'auth', 'uses'=> 'CommentController@store']);

//--------------------------------------------------------------------------------------------------------------



