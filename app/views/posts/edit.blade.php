<?php
    if(Input::old('title')) {
        $title = Input::old('title');
    } else {
        $title = $blogPost->title;
    }
if(Input::old('body')) {
    $body = Input::old('body');
} else {
    $body = $blogPost->body;
}
?>

@extends('master')

@section('content')
    {{Form::model($blogPost, array('action'=>'BlogPostsController@handleEdit'))}}
    {{Form::hidden('id', $blogPost->id)}}
    <div class="title-editable" id="post-title"><h2>{{ $blogPost->title }}</h2></div>
    @foreach($errors->get('title') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach
    <div class="body-editable" id="post-body">{{ $blogPost->body }}</div>
    @foreach($errors->get('body') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach
    <div class="form-group">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        <a href="{{action('BlogPostsController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
        {{Form::close()}}
    </div>
    {{--
    {{Form::model($blogPost, array('action'=>'BlogPostsController@handleEdit'))}}
    {{Form::hidden('id', $blogPost->id)}}
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title" value="{{{$title}}}">
    </div>


    <div class="form-group">
        <label for="body">Body:</label>
        <textarea class="form-control" rows="5" name="body" id="body">{{{$body}}}</textarea>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
    <a href="{{action('BlogPostsController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
    {{Form::close()}}
    </div>
    --}}
@stop

