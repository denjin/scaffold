@extends('layouts.master')

@section('header')
    <a href="{{url('/news')}}">Back to News</a>
@stop



@section('content')
    {{--post container--}}
    <div class="container" id="post-container">

        {{--post title--}}
        @if(Input::old('title'))
            @include('posts.partials.title', array('title' => strip_tags(Input::old('title'))))
        @else
            @include('posts.partials.title', array('title' => $post->title))
        @endif

        {{--title errors--}}
        @foreach($errors->get('title') as $message)
            @include('partials.warning', array('message' => $message))
        @endforeach

        {{--post body--}}
        @if(Input::old('body'))
            @include('posts.partials.body', array('body' => Input::old('body')))
        @else
            @include('posts.partials.body', array('body' => $post->body))
        @endif

        {{--body errors--}}
        @foreach($errors->get('body') as $message)
            @include('partials.warning', array('message' => $message))
        @endforeach

        {{--timestamps--}}
        @include('partials.timestamps', array('author' => $post->user->username, 'created_at' => $post->created_at, 'updated_at' => $post->updated_at))

        {{--form--}}
        @if(Auth::check())
            {{Form::model($post, array('method' => 'PUT', 'route' => array('news.update', $post->id), 'id'=>'post-form'))}}
            {{Form::hidden('id', $post->id)}}
            <input type="hidden" id="post-form-title" name="title">
            <input type="hidden" id="post-form-body" name="body">
            {{Form::close()}}

            {{--form buttons--}}
            <div class="row" id="post-buttons">
                <div class="btn-group">
                <button class="btn btn-success" id="form-submit"><span class="glyphicon glyphicon-ok"></span> Save Changes</button>
                <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel Changes</a>
                <a href="{{url('news/'.$post->slug.'/delete')}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Post</a>
                </div>
            </div>
        @endif
    </div>
@stop

@section('footer')
@if(Auth::check())
@include('editor')
@endif
@stop