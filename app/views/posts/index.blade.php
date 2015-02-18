@extends('layouts.master')
@section('header')
    <h2>News</h2>
@stop
@section('content')
    <div class="container">
        <div class="row"><h4>Blog Posts</h4></div>
            @foreach($posts as $post)
                <div class="row bg-info">
                    <p class="text-primary"><a href="{{url('news/'.$post->slug)}}">{{{$post->title}}}</a></p>
                    <small class="text-muted">{{ str_limit(strip_tags($post->body), $limit = 150, $end = '...') }}</small>
                </div>
            @endforeach
    </div>

    @if(Auth::check())
        <a href="{{url('news/create')}}">
            <span class="glyphicon glyphicon-plus"></span>New Blog Post
        </a>
    @endif
@stop