<?php

class UserController extends BaseController {
	public function register() {
		return View::make('users.register');
	}

	public function handleRegister() {
		//get form input
		$data = Input::all();

		//build validation rules
		$rules = array(
			'username'=>    'required|alpha_num|unique:users,username|min:3',
			'email'=>       'required|email|unique:users,email',
			'password'=>    'required|alpha_num|min:8|confirmed'
		);

		//compare input against validation
		$validator = Validator::make($data, $rules);

		//check if data is valid
		if ($validator->passes()) {
			//create new user
			$user = new User;
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->email = Input::get('email');
			//save user to database
			$user->save();

			return Redirect::back()
				->with('message', 'Account Created');
		} else {
			return Redirect::back()
				->withInput()
				->with('error', "Could not create your account")
				->withErrors($validator);
		}
	}

	public function login() {
		return View::make('users.login');
	}

	public function logout() {
		Auth::logout();
		return Redirect::back()
			->with('message', 'Logged Out');
	}

	public function handleLogin() {
		if(Auth::attempt(Input::only('username', 'password'))) {
			return Redirect::intended('/');
		} else {
			return Redirect::back()
				->withInput()
				->with('error', "Incorrect username or password");
		}
	}


}