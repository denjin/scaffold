<?php

use Presenters\Presenter;
use Presenters\PostPresenter;
use Repositories\Posts\PostRepository as Post;

class PostController extends BaseController {
	//Repositories/Post/PostRepository
	protected $post;
	//Presenters/Presenter
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
		//get the current page
		$page = Input::get('page', 1);
		//
		$data = $this->post->findByPage($page, 10);
		$posts = Paginator::make($data->items, $data->totalItems, 10);

		return View::make('posts.index', compact('posts'));
	}


	//Display the specified resource.
	public function show($slug) {

		//grab the right post
		$post = $this->post->findByKey('slug', $slug);
		//if we found the post
		if($post) {
			//wrap the post in the post presenter
			$post = $this->presenter->model($post, new PostPresenter);
			//make the view
			return View::make('posts.single', compact('post'));
		}

		//return View::make('posts.single')->with('post', $this->post->findByKey('slug', $slug));
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
