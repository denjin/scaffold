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

	public function index() {
		//get the current page
		$page = Input::get('page', 1);
		//
		$data = $this->user->findByPage($page, 10);
		$users = Paginator::make($data->items, $data->totalItems, 10);

		return View::make('users.index', compact('users'));
	}

	public function profile($username) {
		//grab the right user
		$user = $this->user->findByKey('username', $username, array('posts'));
		//if we found the post
		if($user) {
			//wrap the post in the post presenter
			$user = $this->presenter->model($user, new UserPresenter);
			//make the view
			//echo $user->posts;
			return View::make('users.single', compact('user'));
		}
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