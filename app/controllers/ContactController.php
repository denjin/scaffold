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
		$json = Input::json()->all();
		$data = array(
			'first-name' => $json[1]['value'],
			'last-name' => $json[2]['value'],
			'phone-number' => $json[3]['value'],
			'email' => $json[4]['value'],
			'body' => $json[5]['value']
		);

		$rules = array(
			'first-name' => 'required|alpha',
			'last-name' => 'required|alpha',
			'phone-number' => 'numeric|min:8',
			'email' => 'required|email',
			'body' => 'required|min:25'
		);

		$validator = Validator::make($data, $rules);
		$response = array();
		if ($validator->passes()) {
			Mail::queue('emails.contact', $data, function($message) use ($data) {
				$message->from($data['email'], $data['first-name']);
				$message->to('laravelemailtest@gmail.com')->subject('Website Enquiry');
			});
			$response['status'] = 'success';
			$response['message'] = 'Thankyou for your message.';
			return Response::json($response);
			//return Redirect::back()->with('message', 'Thankyou for your message');
		} else {
			$response['status'] = 'failure';
			$response['message'] = 'Could not send your message';
			$errors = $validator->getMessageBag()->toArray();
			$response['errors'] = array($errors);
			return Response::json($response);
			/*return Redirect::back()
				->withInput()
				->with('error', "Could not send your message")
				->withErrors($validator);*/
		}
	}
}