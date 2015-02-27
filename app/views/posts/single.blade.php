@extends('layouts.master')

@section('header')
    {{ Breadcrumbs::render('news.show', $post) }}
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
        <div class="row" id="timestamps">
        @include('partials.timestamps', array('author' => $post->user->username, 'created_at' => $post->created_at, 'updated_at' => $post->updated_at))
            </div>

        {{--form--}}
        @if(Auth::check())

        @endif
    </div>


    <div class="container" id="comments-container">
        @include('comments.comments_list')

    </div>

@stop

@section('footer')
    @if(Auth::check())
        {{--form buttons--}}
        <div class="button-panel" id="post-buttons">
            <small>Admin Panel</small><br />
            {{Form::model($post, array('method' => 'PUT', 'route' => array('news.update', $post->id), 'id'=>'post-form'))}}
            {{Form::hidden('id', $post->id)}}
            <input type="hidden" id="post-form-title" name="title">
            <input type="hidden" id="post-form-body" name="body">
            {{Form::close()}}
            @include('posts.partials.buttons')
            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal"><span class="glyphicon glyphicon-trash"></span> Delete</a>
            @include('posts.delete', array($post))
        </div>
        @include('includes.editor_js')
    @endif
@stop