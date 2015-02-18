<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Build the homepage view
Route::get('/', function() {
	return View::make('welcome');
});


//form to register a new account
Route::get('register', 'UserController@register');
//form to log a user in
Route::get('login', 'UserController@login');
//handle the registration form
Route::post('register', 'UserController@handleRegister');
//handle the login form
Route::post('login', 'UserController@handleLogin');

Route::get('logout', 'UserController@logout');







Route::resource('news', 'PostController');