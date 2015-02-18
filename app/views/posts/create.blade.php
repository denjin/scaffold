
@extends('layouts.master')

@section('content')


    {{Form::open(array('action'=>'PostController@store'))}}
    <input type="hidden" id="title" name="title">
    <input type="hidden" id="body" name="body">
    <input type="hidden" id="user_id" name="user_id" value="{{{Auth::user()->id}}}">


    <div class="title-editable" id="post-title">
        <h2>
        @if(Session::has('old_title'))
            @if(Session::get('old_title') == '')
                Title
            @else
                {{Session::get('old_title')}}
            @endif
        @else
            Title
        @endif
        </h2>
    </div>

    @foreach($errors->get('title') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach



    <div class="body-editable" id="post-body">
        @if(Session::has('old_body'))
            @if(Session::get('old_body') == '')
                <p>Enter the body of your post.</p>
            @else
                {{Session::get('old_body')}}
            @endif
        @else
            <p>Enter the body of your post.</p>
        @endif
    </div>


    @foreach($errors->get('body') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach


    <div class="modal-footer">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
    </div>
    {{Form::close()}}
@stop