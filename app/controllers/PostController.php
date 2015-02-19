<?php

use Repositories\Posts\PostRepository as Post;

class PostController extends BaseController {

	public function __construct(Post $post) {
		$this->post = $post;
		$this->beforeFilter('auth', ['except' => ['index','show']]);
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

	public function storeSuccess($slug) {
		echo "Success";
		echo $slug;
	}

	public function storeFail() {
		echo "Fail";
	}








	//Show the form for editing the specified resource.
	public function edit($slug){
		return View::make('posts.edit', array())->with('post', $this->post->findByKey('slug', $slug));
	}


	//Update the specified resource in storage.
	public function update() {
		echo $this->post->update(Input::all());
	}


	//Remove the specified resource from storage.
	public function destroy($id) {
		//
	}


}
