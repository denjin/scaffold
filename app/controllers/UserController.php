<?php

use Presenters\Presenter;
use Presenters\UserPresenter;
use Repositories\Users\UserRepository as User;

class UserController extends BaseController {
	protected $user;

	public function __construct(User $user, Presenter $presenter) {
		//injected services
		$this->user = $user;
		$this->presenter = $presenter;
	}

	public function register() {
		return View::make('users.register');
	}

	public function handleRegister() {
		return $this->user->store();
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