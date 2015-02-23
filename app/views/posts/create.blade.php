@extends('layouts.master')

@section('content')
    {{--post container--}}
    <div class="container" id="post-container">
        {{--post title--}}
        @if(Input::old('title'))
            @include('posts.partials.title', array('title' => strip_tags(Input::old('title'))))
        @else
            @include('posts.partials.title', array('title' => 'Post Title'))
        @endif

        {{--title errors--}}
        @foreach($errors->get('title') as $message)
            @include('partials.warning', array('message' => $message))
        @endforeach

        {{--post body--}}
        @if(Input::old('body'))
            @include('posts.partials.body', array('body' => Input::old('body')))
        @else
            @include('posts.partials.body', array('body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut orci lobortis, aliquam lorem quis, rhoncus mauris. Pellentesque in dui gravida, luctus elit viverra, condimentum sem. Etiam id posuere lacus. Mauris in ex scelerisque, pulvinar elit eu, pulvinar quam. Phasellus venenatis sem vitae dui hendrerit, sit amet volutpat mauris porttitor. Aenean pretium libero eget aliquet tristique. Nullam lobortis sed felis ut porttitor. Nullam ornare convallis magna, ut pellentesque felis hendrerit ac. Proin quis eros dictum eros commodo volutpat vitae eu leo. Sed quis congue diam, eget pellentesque odio. Morbi sed vestibulum ligula. Fusce id varius sem, id tempor leo. Curabitur ipsum elit, fringilla nec est nec, venenatis bibendum lorem. Nulla rutrum justo eleifend vulputate vulputate. Aliquam ornare sed lorem ut scelerisque. Nam mi justo, vehicula ut pellentesque eget, fermentum eget lorem.'))
        @endif

        {{--Body Errors--}}
        @foreach($errors->get('body') as $message)
            @include('partials.warning', array('message' => $message))
        @endforeach

        {{--form--}}
        {{Form::open(array('action'=>'PostController@store', 'id'=>'post-form'))}}
        <input type="hidden" id="post-form-title" name="title">
        <input type="hidden" id="post-form-body" name="body">
        <input type="hidden" id="post-form-user_id" name="user_id" value="{{{Auth::user()->id}}}">
        {{Form::close()}}

        {{--form buttons--}}
        <div class="row" id="post-buttons">
            <div class="btn-group">
            <button class="btn btn-success" id="form-submit"><span class="glyphicon glyphicon-ok"></span> Save Changes</button>
            <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel Changes</a>
                </div>
        </div>
    </div>
@stop

@section('footer')
    @if(Auth::check())
        @include('editor')
    @endif
@stop