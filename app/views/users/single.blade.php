@extends('layouts.master')

@section('header')
    {{ Breadcrumbs::render('users.profile', $user) }}
@stop



@section('content')
    {{--post container--}}
    <div class="container" id="post-container">

        {{--username--}}
        <h1 class="text-center">
            <strong>
                {{{$user->username}}}
            </strong>
        </h1>


        {{--posts--}}
        @foreach($user->posts as $post)
            @include('posts.partials.post_min', array('slug' => $post->slug, 'title' => $post->title, 'body' => str_limit(strip_tags($post->body), $limit = 150, $end = '...')))
        @endforeach
    </div>
@stop

@section('footer')

@stop