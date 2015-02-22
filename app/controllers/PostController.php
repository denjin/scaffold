<?php

use Presenters\Presenter;
use Presenters\PostPresenter;
use Repositories\Posts\PostRepository as Post;

class PostController extends BaseController {
	protected $post;
	protected $presenter;

	public function __construct(Post $post, Presenter $presenter) {
		//injected services
		$this->post = $post;
		$this->presenter = $presenter;

		//controller action filters
		$this->beforeFilter('auth', ['except' => ['index','show']]);
		$this->beforeFilter('csrf', ['on' => ['store', 'update', 'destroy']]);
	}

	//Get a list of all posts
	public function index() {
		return View::make('posts.index')->with('posts', $this->post->all());
	}


	//Display the specified resource.
	public function show($slug) {
		$post = $this->post->findByKey('slug', $slug);
		if($post) {
			$post = $this->presenter->model($post, new PostPresenter);
			return View::make('posts.single', compact('post'));
		}
		App::abort(404);
	}

	//Show the form for creating a new resource.
	public function create() {
		return View::make('posts.create');
	}

	//Store a newly created resource in storage.
	public function store() {
		return $this->post->store();
	}


	//Update the specified resource in storage.
	public function update() {
		return $this->post->update(Input::all());
	}

	//Show the form to delete a post
	public function delete($slug) {
		return View::make('posts.delete')->with('post', $this->post->findByKey('slug', $slug));
	}


	//Remove the specified resource from storage.
	public function destroy() {
		return $this->post->destroy();
	}


}
