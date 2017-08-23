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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/post','PostWatcherController@index');
Route::get('/r/{all?}','PostWatcherController@index');
Route::get('/post/new','PostWatcherController@store');
Route::get('/post/update','PostWatcherController@update');
Route::get('/post/{postWatcher}','PostWatcherController@show');
Route::get('/byidtest/','PostWatcherController@byIdTest');
Route::get('/r/{subreddit}/comments/{reddit_id}/{extra_url}','PostWatcherController@redditurltest');
Route::get('rising','PostWatcherController@getRandomIdFromRising');
Route::get('frontpage', 'PostWatcherController@frontPage');
