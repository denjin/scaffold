<?php namespace Repositories\Posts;

use Repositories\AbstractEloquentRepository;
use Post;
use Validator;
use Redirect;
use Input;

class EloquentPostRepository extends AbstractEloquentRepository implements PostRepository {

    public function __construct(Post $model) {
        $this->model = $model;
    }

    public function store() {

        $rules = array(
            'title'=>   'required|unique:posts,title|min:5',
            'body'=>    'required'
        );

        //compare input against validation
        $validator = Validator::make(Input::all(), $rules);

        //check if data is valid
        if ($validator->passes()) {
            //create new blog post
            $post = new Post();
            $post->title = strip_tags(Input::get('title'));
            $post->body = Input::get('body');
            $post->user_id = Input::get('user_id');
            //save new post
            $post->save();
            return Redirect::to('news/'.$post->slug)->with('message', 'Successfully created page.');
        } else {
            return Redirect::back()
                ->with('error', 'Could not create your blog post')
                ->withErrors($validator)
                ->withInput();
        }
    }


    public function update($data) {
        $data['title'] = strip_tags($data['title']);

        $rules = array(
            'title'=>   'required|unique:posts,title|min:5',
            'body'=>    'required',
            'user_id' => 'required'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $post = Post::findOrFail(Input::get('id'));
            $post->title = Input::get('title');
            $post->body = Input::get('body');
            $post->save();
            return Redirect::to('news/'.$post->slug)->with('message', 'Successfully edited page!');
        } else {
            return Redirect::back()
                ->with('error', 'Could not create your blog post')
                ->withErrors($validator)
                ->with('old_title', $data['title'])
                ->with('old_body', $data['body']);
        }
    }
}