@extends('layouts.master')
@section('header')
    <h2>News</h2>
@stop
@section('content')
    <div class="container">
        @if(Auth::check())
            <div class="row">
            <a href="{{url('news/create')}}">
                <span class="glyphicon glyphicon-plus"></span>New Blog Post
            </a>
            </div>
        @endif
        @foreach($posts as $post)
            @include('posts.partials.post_min', array('slug' => $post->slug, 'title' => $post->title, 'body' => str_limit(strip_tags($post->body), $limit = 150, $end = '...')))
        @endforeach
        <div class="row">
            {{ $posts->links() }}
        </div>
    </div>
@stop