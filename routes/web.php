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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/user', function(){
//     // return App\User::find(3);
//     // return App\User::where('github_id', '=', 38908145)->first();
//     return Auth::user()->name;
// });
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/', function(){
  return view('layout');
})->name('home');

Route::get('about', function(){
  return view('about');
});

Route::get('/profile', 'UserController@profile');

Route::get('/devlogin', 'UserController@devlogin');

Route::resource('bookmarks', 'BookmarkController');
Route::get('bookmarks/category/{category}', 'BookmarkController@indexByCategory');
Route::get('bookmarks/user/{id}', 'BookmarkController@indexByUser');

Route::get('login/github', 'LoginController@redirectToProvider')->name('login');
Route::get('login/github/callback', 'LoginController@handleProviderCallback');
