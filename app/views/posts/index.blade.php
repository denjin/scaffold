@extends('layouts.master')
@section('header')
    {{ Breadcrumbs::render() }}
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
            @include('posts.partials.post_min', array('slug' => $post->slug, 'title' => $post->title, 'body' => str_limit(strip_tags($post->body), $limit = 250, $end = '...'), 'created' => $post->created_at))
        @endforeach
        <div class="row">
            {{ $posts->links() }}
        </div>
    </div>
@stop