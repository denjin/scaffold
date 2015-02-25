<?php

class ContactController extends BaseController {
	/**
	 * load contact form
	 * @return mixed
	 */
	public function contact() {
		return View::make('contact.contact');
	}


	public function handleContact() {
		$data = Input::all();
		$rules = array(
			'first-name' => 'required|alpha',
			'last-name' => 'required|alpha',
			'phone-number' => 'numeric|min:8',
			'email' => 'required|email',
			'message' => 'required|min:25'
		);

		$validator = Validator::make($data, $rules);

		if ($validator->passes()) {
			Mail::queue('emails.contact', $data, function($message) use ($data) {
				$message->from($data['email'], $data['first-name']);
				$message->to('laravelemailtest@gmail.com')->subject('Website Enquiry');
			});
			return Redirect::back()->with('message', 'Thankyou for your message');
		} else {
			return Redirect::back()
				->withInput()
				->with('error', "Could not send your message")
				->withErrors($validator);
		}
	}
}



