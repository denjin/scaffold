<?php
    if(Input::old('title')) {
        $title = Input::old('title');
    } else {
        $title = $post->title;
    }
if(Input::old('body')) {
    $body = Input::old('body');
} else {
    $body = $post->body;
}
?>

@extends('layouts.master')

@section('content')
    {{Form::model($post, array('method' => 'PUT', 'route' => array('news.update', $post->id)))}}
    {{Form::hidden('id', $post->id)}}
    <input type="hidden" id="title" name="title">
    <input type="hidden" id="body" name="body">

    <div class="title-editable" id="post-title">
        <h2>{{ $post->title }}</h2>
    </div>
    @foreach($errors->get('title') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach
    <div class="body-editable" id="post-body">{{ $post->body }}</div>
    @foreach($errors->get('body') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach
    <div class="form-group">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
        {{Form::close()}}
    </div>
@stop