@extends('layouts.master')

@section('header')
    <a href="{{url('/news')}}">Back to News</a>
@stop

@section('content')


    @if(Auth::check())
        <div id="auth">
            <a href="{{url('news/'.$post->slug.'/edit')}}">
                <span class="glyphicon glyphicon-edit"></span>Edit
            </a>
            <a href="{{url('news/'.$post->slug.'/delete')}}">
                <span class="glyphicon glyphicon-trash"></span>Delete
            </a>
        </div>
    @endif

    @if(Auth::check())
        @if(Auth::user()->id == $post->user_id)
            <div class="alert alert-warning"><span class="glyphicon glyphicon-exclamation-sign"></span>You can edit this post.</div>
        @endif
    @endif

    <div id="title">
        <h2>{{$post->title}}</h2>
    </div>




    <div id="content">
        {{$post->body}}
    </div>

    <div class="panel-default" id="timestamps">
        <p class="text-muted small">Post created: {{$post->created_at->format('dS M Y \a\t G:i')}}<br />Last modified: {{$post->updated_at->format('dS M Y \a\t G:i')}}</p>
    </div>
@stop