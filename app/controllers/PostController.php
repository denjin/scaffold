<?php
use Repositories\Posts\PostRepositoryInterface as Post;

class PostController extends BaseController {
	//Repositories/Post/PostRepository
	protected $post;

	public function __construct(Post $post) {
		//injected services
		$this->post = $post;

		//controller action filters
		$this->beforeFilter('auth', ['except' => ['index','show']]);
		$this->beforeFilter('csrf', ['on' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Get a list of all posts
	 * @return view builder
	 */

	public function index() {
		//get the current page
		$page = Input::get('page', 1);
		//
		$data = $this->post->findByPage($page, 5);
		$posts = Paginator::make($data->items, $data->totalItems, 5);

		if($posts) {
			return View::make('posts.index', compact('posts'));
		}


	}


	/**
	 * Display the specified resource
	 * @param $slug - string - the slug to search the posts for
	 * @return view builder
	 */

	public function show($slug) {
		//grab the right post
		$post = $this->post->findByKey('slug', $slug, array('user'));
		//if we found the post
		if($post) {
			//make the view
			return View::make('posts.single', compact('post'));
		}
	}

	//Show the form for creating a new resource.
	public function create() {
		return View::make('posts.create');
	}

	//Store a newly created resource in storage.
	public function store() {
		return $this->post->store(Input::all());
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
		return $this->post->destroy(Input::all());
	}


}
