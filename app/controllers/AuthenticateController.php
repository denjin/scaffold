<?php

use Illuminate\Support\Facades\Session;
use OAuth;

class AuthenticateController extends \BaseController {
	protected $session;

	public function __construct(Session $session) {
		$this->session = $session;
	}



	public function facebook() {
		//get data from input
		$code = Input::get('code');
		$fb = Oauth::consumer('Facebook');
		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {
			// This was a callback request from facebook, get the token
			$token = $fb->requestAccessToken( $code );
			// Send a request with it
			$result = json_decode( $fb->request( '/me' ), true );
			//$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			//send username, token  and secret token to the session

			Session::put(
				'username', $result['name'],
				'token', $token
				);
			return Redirect::back()->with('message', 'You are now logged in.');
		}

		// if not ask for permission first
		else {
			// get fb authorization
			$url = $fb->getAuthorizationUri();

			// return to facebook login url
			return Redirect::to( (string)$url );
		}
	}

	public function twitter() {

	}

	public function google() {

	}
}