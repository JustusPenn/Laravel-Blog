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
// use Auth;
use App\Profile;


Route::get('/', 'MainController@index');
// route::get('/master', 'HomeController@master');

Route::resource('blog', 'BlogController');

Route::resource('comment', 'CommentController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

/**
 * Profile Routes 
 */

Route::get('/profile-set', 'HomeController@profileSet')->name('profile.set');
Route::post('/profile-set', 'HomeController@createProfile')->name('profile.create');
Route::get('/profile/{profile}', 'HomeController@viewProfile')->name('profile');
Route::get('/profile/edit/{profile}', 'HomeController@editProfile')->name('profile.edit');
Route::post('/profile/update/{profile}', 'HomeController@updateProfile')->name('profile.update');

View::composer(['*'], function ($view)
{
    if (Auth::check()) {
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $view->with('profile', $profile);
    }
});

/** 
 * Landing page routes Page No Auth required
*/
Route::get('/article/{blog}', 'MainController@showPost')->name('blog.article');
Route::post('article/comment', 'MainController@createComment')->name('article.comment');


