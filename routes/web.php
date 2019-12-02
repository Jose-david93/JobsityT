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


Route::get('/', 'Entries\EntriesController@index')->name('entries');
Route::get('/create', 'Entries\EntriesController@create')->name('create_entries')->middleware('auth');
Route::get('/edit/{id}', 'Entries\EntriesController@edit')->name('edit_entry')->middleware('auth');
Route::get('/show/{id}/{name_tweet}', 'Users\UsersController@show')->name('user');
Route::post('/store', 'Entries\EntriesController@store')->name('store_entries')->middleware('auth');
Route::post('/update', 'Entries\EntriesController@update')->name('update_entries')->middleware('auth');
Route::post('/hidetweets', 'Users\UsersController@hideTweets')->middleware('auth');
Route::post('/showtweets', 'Users\UsersController@showTweets')->middleware('auth');

Auth::routes();
Route::get('/home', 'Entries\EntriesController@index')->name('home');