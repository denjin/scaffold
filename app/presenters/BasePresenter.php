<?php namespace Presenters;

use ArrayAccess;

abstract class BasePresenter implements ArrayAccess {
    //the object to present
    protected $object;

    //Inject the object to be presented
    public function set($object) {
        $this->object = $object;
    }

    //Checks to see if the offset exists on the current object
    public function offsetExists($key) {
        return isset($this->object[$key]);
    }

    //Retrieve the key from the object as if it were an array (square brackets)
    public function offsetGet($key) {
        return $this->__get($key);
    }

    //Set the key of an object as if it were an array
    public function offsetSet($key, $value) {
        $this->object[$key] = $value;
    }

    //Unset the key of an object as if it were an array
    public function offsetUnset($key) {
        unset($this->object[$key]);
    }

    //Check to see if there's a method on the presenter, else pass through to the object
    public function __get($key) {
        if(method_exists($this, $key)) {
            return $this->{$key}();
        }
        return $this->object->$key;
    }

    //formats the date_time fields auto-created by laravel
    public function created_at() {
        return $this->object->created_at->format('F jS, Y');
    }

    public function updated_at() {
        return $this->object->updated_at->format('dS M Y \a\t G:i');
    }
}