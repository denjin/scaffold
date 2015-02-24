<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Post extends Eloquent implements SluggableInterface, PresenterInterface {


    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    protected $fillable = array('title', 'body', 'user_id,');

    public function Post() {

    }

    public function user() {
        return $this->belongsTo('User', 'user_id');
    }

    public function getPresenter() {
        return 'Presenters\PostPresenter';
    }
}