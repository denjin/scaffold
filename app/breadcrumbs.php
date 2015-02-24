<?php

Breadcrumbs::register('home', function($breadcrumbs) {
	$breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('news.index', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('News', route('news.index'));
});

Breadcrumbs::register('news.show', function($breadcrumbs, $post) {
	$breadcrumbs->parent('news.index');
	$breadcrumbs->push($post->slug, route('news.show'));
});

Breadcrumbs::register('news.create', function($breadcrumbs) {
	$breadcrumbs->parent('news.index');
	$breadcrumbs->push('New Post', route('news.create'));
});


Breadcrumbs::register('users', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Users', route('users'));
});

Breadcrumbs::register('users.profile', function($breadcrumbs, $user) {
	$breadcrumbs->parent('users');
	$breadcrumbs->push($user->username, route('users.profile'));
});