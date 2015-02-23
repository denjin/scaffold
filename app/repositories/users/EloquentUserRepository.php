<?php namespace Repositories\Users;

use Repositories\BaseEloquentRepository;
use User;
use Validator;
use Redirect;
use Hash;
use Auth;
use Input;

class EloquentUserRepository extends BaseEloquentRepository implements UserRepository {

	public function __construct(User $model) {
		$this->model = $model;
	}

	public function store() {
		//pre-sanitise the input data
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

	public function update() {

	}

	public function destroy() {

	}

}