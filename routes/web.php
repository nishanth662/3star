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
    if(\Illuminate\Support\Facades\Auth::check())
    {
        return redirect('home');
    }
    else
    {
        return redirect('login');
    }
});


Auth::routes();

Route::get('/home', 'HomeController@index');



Route::resource('admins', 'adminController');

Route::resource('users', 'userController');



Route::resource('utilities', 'sportsController');

Route::resource('sportsEvents', 'sports_eventsController');

Route::resource('sportsImages', 'sportsImageController');

Route::resource('eventImages', 'eventImageController');

Route::get('search_sports','adminController@search_sports');