
@extends('layouts.master')

@section('content')
    <div>
        @if(Session::has('old_body'))
            {{$body = strip_tags(Session::get('old_body'))}}
            @else
            {{$body = 'Body'}}
        @endif

        @if(Session::has('old_title'))
            {{$title = Session::get('old_title')}}
            @else
            {{$title = 'Title'}}
        @endif
    </div>


    {{Form::open(array('action'=>'PostController@store'))}}
    <input type="text" id="title" name="title">
    <input type="text" id="body" name="body">
    <input type="text" id="user_id" name="user_id" value="{{{Auth::user()->id}}}">


    <div class="title-editable" id="post-title">
        @if(Session::has('old_title'))
            {{Session::get('old_title')}}
        @else
            <h2>{{$title}}</h2>
        @endif

    </div>
    @foreach($errors->get('title') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach



    <div class="body-editable" id="post-body">
        @if(Session::has('old_body'))
            {{Session::get('old_body')}}
        @else
            {{$body}}
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