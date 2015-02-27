<?php namespace Repositories\Posts;

/**
 * This class is contain the store, update and destroy methods unique to the Post entities.
 */

use Repositories\BaseEloquentRepository;
use Post;
use Validator;
use Redirect;
use StdClass;

class EloquentPostRepository extends BaseEloquentRepository implements PostRepositoryInterface {

    public function __construct(Post $model) {
        $this->model = $model;
    }

    /**
     * stores an entry in the database
     * @return mixed
     */
    public function store(array $data) {
        //clean up the inputted title (medium editor has a tendency to add junk to the input and we just want raw text for the title
        $data['title'] = trim(strip_tags($data['title']));
        $data['title'] = str_replace('&nbsp;', ' ', $data['title']);

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
            $post->body = $data['body'];
            $post->user_id = $data['user_id'];
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

    /**
     * updates an entry in the database
     * @return mixed
     */
    public function update(array $data) {
        $data['title'] = trim(strip_tags($data['title']));

        //build validation rules
        $rules = array(
            'title'=>   'required|unique:posts,title|min:5',
            'body'=>    'required'
        );
        //compare input against validation
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            //find the post that is to be updated
            $post = Post::findOrFail($data['id']);
            $post->title = $data['title'];
            $post->body = $data['body'];
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

    /**
     * removes an entry from the database
     * @return mixed
     */
    public function destroy($data) {
        $post = Post::findOrFail($data['id']);
        $post->delete();
        return Redirect::to('news/')
            ->with('message', 'Successfully deleted page!');
    }
}