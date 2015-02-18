<?php namespace Repositories\Posts;

use Repositories\AbstractEloquentRepository;
use Post;
use Validator;
use Redirect;

class EloquentPostRepository extends AbstractEloquentRepository implements PostRepository {

    public function __construct(Post $model) {
        $this->model = $model;
    }

    public function store($data) {
        $rules = array(
            'title'=>   'required|unique:posts,title|min:5',
            'body'=>    'required',
            'user_id' => 'required'
        );

        //compare input against validation
        $validator = Validator::make($data, $rules);

        //check if data is valid
        if ($validator->passes()) {
            //create new blog post
            $post = new Post();
            $post->title = strip_tags($data['title']);
            $post->body = $data['body'];
            $post->user_id = $data['user_id'];
            //save new post
            $post->save();
            return Redirect::to('news/'.$post->slug)->with('message', 'Successfully created page!');
        } else {
            return Redirect::back()
                ->with('error', 'Could not create your blog post')
                ->withErrors($validator)
                ->with('old_title', $data['title'])
                ->with('old_body', $data['body']);
        }
    }
}