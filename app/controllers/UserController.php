<?php

use Repositories\Users\UserRepository as User;
//use Artdarek\OAuth\Facade\OAuth;
use OAuth;

class UserController extends BaseController {
	protected $user;

	public function __construct(User $user) {
		//injected services
		$this->user = $user;
	}

	public function index() {
		//get the current page
		$page = Input::get('page', 1);
		//
		$data = $this->user->findByPage($page, 10, array('posts'));
		$users = Paginator::make($data->items, $data->totalItems, 10);

		return View::make('users.index', compact('users'));
	}

	public function profile($username) {
		//grab the right user
		$user = $this->user->findByKey('username', $username, array('posts'));
		//if we found the post
		if($user) {
			//make the view
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
			return Redirect::back()
				->with('message', 'You are now logged in.');
		} else {
			return Redirect::back()
				->withInput()
				->with('error', "Incorrect username or password");
		}
	}


	public function loginWithFacebook() {
		//get data from input
		$code = Input::get('code');
		$fb = Oauth::consumer('Facebook');
		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {
			// This was a callback request from facebook, get the token
			$token = $fb->requestAccessToken( $code );
			// Send a request with it
			$result = json_decode( $fb->request( '/me' ), true );
			$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			echo $message. "<br/>";
			//Var_dump
			dd($result);
		}
		// if not ask for permission first
		else {
			// get fb authorization
			$url = $fb->getAuthorizationUri();

			// return to facebook login url
			return Redirect::to( (string)$url );
		}
	}


}