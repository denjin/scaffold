<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 27/02/15
 * Time: 13:44
 */

use McCool\LaravelAutoPresenter\PresenterInterface;

class Comment extends Eloquent implements PresenterInterface {



	public function getPresenter() {
		return 'Presenters\PostPresenter';
	}

	public function post() {
		return $this->belongsTo('Post', 'post_id');
	}

	public function user() {
		return $this->belongsTo('User', 'user_id');
	}
}