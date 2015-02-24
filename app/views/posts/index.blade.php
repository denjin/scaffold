@extends('layouts.master')
@section('header')
    {{--where we are breadcrumbs--}}
    {{ Breadcrumbs::render() }}
@stop

@section('content')
    {{--list of posts with links--}}
    <div class="container">
        @foreach($posts as $post)
            @include('posts.partials.post_min', array('slug' => $post->slug, 'title' => $post->title, 'body' => str_limit(strip_tags($post->body), $limit = 250, $end = '...'), 'created' => $post->created_at))
        @endforeach
    </div>
@stop

@section('footer')
    {{--add admin panel if logged in--}}
    @if(Auth::check())
        <div class="button-panel">
            <small>Admin Panel</small><br />
            <a href="{{url('news/create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span> New Post
            </a>
        </div>
    @endif
@stop