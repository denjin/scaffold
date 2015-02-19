@extends('layouts.master')

@section('content')
    <div class="page-header"><h2>Delete a Blog Post?</h2></div>
    {{Form::model($post, array('method' => 'DELETE', 'route' => array('news.destroy', $post->id)))}}
    {{Form::hidden('id', $post->id)}}
        <div class="alert alert-danger">
            <strong>This cannot be undone!</strong>
        </div>
    <div class="form-group">
        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
        <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
    </div>

    {{Form::close()}}
@stop