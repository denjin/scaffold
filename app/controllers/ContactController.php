<?php

class ContactController extends BaseController {
	/**
	 * load contact form
	 * @return mixed
	 */
	public function contact() {
		return View::make('contact.contact');
	}

	/**
	 * process the contact form
	 * @return mixed
	 */
	public function handleContact() {
		//grab input
		$json = Input::json()->all();
		//parse input
		$data = array(
			'first-name' => $json[1]['value'],
			'last-name' => $json[2]['value'],
			'phone-number' => $json[3]['value'],
			'email' => $json[4]['value'],
			'body' => $json[5]['value']
		);
		//build validation rules
		$rules = array(
			'first-name' => 'required|alpha',
			'last-name' => 'required|alpha',
			'phone-number' => 'numeric|min:8',
			'email' => 'required|email',
			'body' => 'required|min:25'
		);
		//validate input
		$validator = Validator::make($data, $rules);
		//check if valid input
		if ($validator->passes()) {
			//send email
			Mail::queue('emails.contact', $data, function($message) use ($data) {
				$message->from($data['email'], $data['first-name']);
				$message->to('laravelemailtest@gmail.com')->subject('Website Enquiry');
			});
			//respond
			return Response::json(array('success' => true, 'errors' => '', 'message' => 'Thankyou for your message.'));
		} else {
			//respond
			return Response::json(array('success' => false, 'errors' => $validator, 'message' => 'We could not send your message.'));
		}
	}
}