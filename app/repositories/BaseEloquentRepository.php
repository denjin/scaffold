<?php namespace Repositories;
/**
 *
 * This class is designed to abstract away common methods from the individual repositories.
 *
 */

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
    public function findByPage($limit = 10) {
        return $this->model->paginate($limit, ['*']);
    }

    //Update an entry

    //Remove an entry
}