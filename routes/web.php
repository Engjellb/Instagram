<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/emails', function () {
    return new \App\Mail\NewUserMail();
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profiles/{user}', 'ProfileController@index')->name('profile.index');

Route::get('profile/{user}/edit', 'ProfileController@edit')->name('profiles.edit');

Route::put('/profile/{user}', 'ProfileController@update')->name('profiles.update');

Route::get('/posts/create', 'PostController@create')->name('posts.create');

Route::get('/posts/{post}', 'PostController@show')->name('posts.show');

Route::post('/posts', 'PostController@store')->name('posts.store');

Route::post('/follow/{user}', 'FollowsController@store');

