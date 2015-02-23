<?php namespace Repositories;
/**
 *
 * This class is designed to abstract away common methods from the individual repositories.
 *
 */

use StdClass;

class BaseEloquentRepository {
    protected $model = null;

    //Get all entries
    public function all() {
        return $this->model->all();
    }
    //Get single entry by primary key
    public function find($id) {
        return $this->model->find($id);
    }
    //Get single entry by field
    public function findByKey($key, $value) {
        return $this->model->where($key, '=', $value)->first();
    }
    //Get multiple entries by field
    public function findManyByKey($key, $value) {
        return $this->model->where($key, '=', $value)->get();
    }

    //Get paginated results
    public function findByPage($page = 1, $limit = 10, $sortField = 'created_at', $sortDir = 'desc') {
        //create empty object
        $results = new StdClass();
        //push parameters into results object
        $results->page = $page;
        $results->limit = $limit;
        $results->totalItems = 0;
        $results->items = array();
        //query the data with the parameters
        $posts = $this->model->orderBy($sortField, $sortDir)->skip($limit * ($page - 1))->take($limit)->get();
        //add the total items to the results
        $results->totalItems = $this->model->count();
        //add the data to the results
        $results->items = $posts->all();
        return $results;
    }
}