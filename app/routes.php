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
Route::get('/', array(
	'as' => 'home',
	function() {
	return View::make('welcome');
}));


//form to register a new account
Route::get('register', 'UserController@register');
//form to log a user in
Route::get('login', 'UserController@login');
//handle the registration form
Route::post('register', 'UserController@handleRegister');
//handle the login form
Route::post('login', 'UserController@handleLogin');

Route::get('logout', 'UserController@logout');

Route::get('users', array(
		'as' => 'users',
		'uses' => 'UserController@index'));

Route::get('users/{user}', array(
	'as' => 'users.profile',
	'uses' => 'UserController@profile'));





Route::resource('news', 'PostController');
Route::get('news/{post}/delete', 'PostController@delete');




//contact form
Route::get('contact', 'ContactController@contact');
Route::post('contact', 'ContactController@handleContact');


//Social Authentication - Authenticate via external provider
Route::get('auth/facebook', array('uses' => 'AuthenticateController@facebook', 'as' => 'authenticate.facebook'));