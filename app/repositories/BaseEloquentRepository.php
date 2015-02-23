<?php namespace Repositories;
/**
 *
 * This class is designed to abstract away common methods from the individual repositories.
 *
 */

use StdClass;

class BaseEloquentRepository {
    protected $model = null;

    /**
     * find all entries in a table
     * @return array of results
     */

    public function all() {
        return $this->model->all();
    }

    /**
     * find a single entry by the primary key
     * @param $id - int - key to find
     * @return eloquent model
     */

    public function find($id) {
        return $this->model->find($id);
    }

    /**
     * finds a single entry by a field on a column
     * @param $key - string - column to search
     * @param $value - string - field to find
     * @return eloquent model
     */

    public function findByKey($key, $value) {
        return $this->model->where($key, '=', $value)->first();
    }

    /**
     * find many entries by a field on a column
     * @param $key - string - column to search
     * @param $value - string - field to find
     * @return array of results
     */

    public function findManyByKey($key, $value) {
        return $this->model->where($key, '=', $value)->get();
    }

    /**
     * gets a paginated set of results
     * @param int $page - page of results to grab
     * @param int $limit - number of results to show
     * @param string $sortField - column to paginate by
     * @param string $sortDir - direction to paginate in
     * @return StdClass
     */

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