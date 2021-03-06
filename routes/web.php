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
    if (\Auth::check()) return redirect('home');
    return view('welcome');
});

// Auth::routes();
Route::get('/login', 'Auth\Auth0IndexController@login' )->name( 'login' );
Route::get('/logout', 'Auth\Auth0IndexController@logout' )->name( 'logout' )->middleware('auth');

Route::get( '/auth0/callback', '\Auth0\Login\Auth0Controller@callback' )->name( 'auth0-callback' );

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reminder/{reminder}/snooze', 'DecisionReminderController@snooze')->middleware('auth');
Route::post('/reminder', 'DecisionReminderController@create')->middleware('auth');
Route::delete('/reminder', 'DecisionReminderController@delete')->middleware('auth');
