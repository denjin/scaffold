@extends('layouts.master')

@section('header')
    <a href="{{url('/news')}}">Back to News</a>
@stop

@section('content')

    <div class="container-fluid" id="post-container">
        <div id="post-title" class="title-editable row">
            @if(Input::old('title'))
                {{strip_tags(Input::old('title'))}}
            @else
                <h1 class="text-center text-"><strong>{{$post->title}}</strong></h1>
            @endif
        </div>

        <div id="post-body" class="body-editable row">
            @if(Input::old('body'))
                {{Input::old('body')}}
            @else
                {{$post->body}}
            @endif
        </div>

        <div class="row" id="timestamps">
            <p class="text-muted small">Post created: {{$post->created_at->format('dS M Y \a\t G:i')}}<br />Last modified: {{$post->updated_at->format('dS M Y \a\t G:i')}}</p>
        </div>

        @if(Auth::check())
            {{Form::model($post, array('method' => 'PUT', 'route' => array('news.update', $post->id), 'id'=>'post-form'))}}
            {{Form::hidden('id', $post->id)}}
            <input type="hidden" id="post-form-title" name="title">
            <input type="hidden" id="post-form-body" name="body">
            {{Form::close()}}


            <div class="row" id="post-buttons">
                <button class="btn btn-success" id="form-submit"><span class="glyphicon glyphicon-ok"></span> Save Changes</button>
                <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel Changes</a>
                <a href="{{url('news/'.$post->slug.'/delete')}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Post</a>
            </div>
        @endif
    </div>




@stop

@section('footer')
    @if(Auth::check())
        @include('editor')
    @endif
@stop