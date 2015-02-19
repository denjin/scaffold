<?php

use Repositories\Posts\PostRepository as Post;

class PostController extends BaseController {

	public function __construct(Post $post) {
		$this->post = $post;
		$this->beforeFilter('auth', ['except' => ['index','show']]);
		$this->beforeFilter('csrf', ['on' => ['store', 'update', 'destroy']]);
	}

	//Get a list of all posts
	public function index() {
		return View::make('posts.index')->with('posts', $this->post->all());
	}

	//Display the specified resource.
	public function show($slug) {
		//find post by slug
		//return View::make('posts.single')->with('posts', $this->post->find($id));
		return View::make('posts.single')->with('post', $this->post->findByKey('slug', $slug));
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
	public function destroy($id) {
		return $this->post->destroy($id);
	}


}
