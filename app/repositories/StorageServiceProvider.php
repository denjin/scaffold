<?php namespace Repositories;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(
            'Repositories\Users\UserRepository',
            'Repositories\Users\EloquentUserRepository'
        );

        $this->app->bind(
            'Repositories\Posts\PostRepository',
            'Repositories\Posts\EloquentPostRepository'
        );
    }

}