<?php namespace Repositories\Posts;

use Repositories\BaseEloquentRepository;
use Post;
use Validator;
use Redirect;
use Input;
use StdClass;

class EloquentPostRepository extends BaseEloquentRepository implements PostRepository {

    public function __construct(Post $model) {
        $this->model = $model;
    }

    public function store() {
        //pre-sanitise the input data
        $data = Input::all();
        $data['title'] = trim(strip_tags($data['title']));
        //build validation rules
        $rules = array(
            'title'=>   'required|unique:posts,title|min:5',
            'body'=>    'required'
        );

        //compare input against validation
        $validator = Validator::make($data, $rules);

        //check if data is valid
        if ($validator->passes()) {
            //create new blog post
            $post = new Post();
            $post->title = $data['title'];
            $post->body = Input::get('body');
            $post->user_id = Input::get('user_id');
            //save new post
            $post->save();
            return Redirect::to('news/'.$post->slug)
                ->with('message', 'Successfully created page.');
        } else {
            //if data not valid, redirect to the form with errors and the sent data
            return Redirect::back()
                ->with('error', 'Could not create your blog post')
                ->withErrors($validator)
                ->withInput();
        }
    }


    public function update() {
        //pre-sanitise the input data
        $data = Input::all();
        $data['title'] = trim(strip_tags($data['title']));

        //build validation rules
        $rules = array(
            'title'=>   'required|unique:posts,title|min:5',
            'body'=>    'required'
        );
        //compare input against validation
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            //find the post that is to be updated
            $post = Post::findOrFail(Input::get('id'));
            $post->title = $data['title'];
            $post->body = Input::get('body');
            //save the new data over the top
            $post->save();
            //redirect back to the page
            return Redirect::to('news/'.$post->slug)->with('message', 'Successfully edited page!');
        } else {
            //redirect back with errors and the sent data
            return Redirect::back()
                ->with('error', 'Could not edit your blog post')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function destroy() {
        $post = Post::findOrFail(Input::get('id'));
        $post->delete();
        return Redirect::to('news/')
            ->with('message', 'Successfully deleted page!');
    }


    //Get paginated results
    public function findByPage($page = 1, $limit = 10) {
        //create empty object
        $results = new StdClass();
        //push parameters into results object
        $results->page = $page;
        $results->limit = $limit;
        $results->totalItems = 0;
        $results->items = array();
        //query the data with the parameters
        $posts = $this->model->skip($limit * ($page - 1))->take($limit)->get();
        //add the total items to the results
        $results->totalItems = $this->model->count();
        //add the data to the results
        $results->items = $posts->all();
        return $results;
    }

}