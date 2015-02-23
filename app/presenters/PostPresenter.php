<?php namespace Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;
use Post;
use Carbon\Carbon;

class PostPresenter extends BasePresenter {
	public function __construct(Post $post) {
		$this->resource = $post;
	}

	public function created_at() {
		return $this->resource->created_at->format('dS M Y \a\t G:i');
	}
}