
@extends('layouts.master')

@section('content')


    {{Form::open(array('action'=>'PostController@store', 'id'=>'form'))}}
    <input type="hidden" id="title" name="title">
    <input type="hidden" id="body" name="body">
    <input type="hidden" id="user_id" name="user_id" value="{{{Auth::user()->id}}}">
    {{Form::close()}}

    <div class="title-editable" id="post-title"><h2>
        @if(Input::old('title'))
            {{strip_tags(Input::old('title'))}}
        @else
            Post Title
        @endif
    </h2></div>

    @foreach($errors->get('title') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach



    <div class="body-editable" id="post-body">
        @if(Input::old('body'))
            {{Input::old('body')}}
        @else
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut orci lobortis, aliquam lorem quis, rhoncus mauris. Pellentesque in dui gravida, luctus elit viverra, condimentum sem. Etiam id posuere lacus. Mauris in ex scelerisque, pulvinar elit eu, pulvinar quam. Phasellus venenatis sem vitae dui hendrerit, sit amet volutpat mauris porttitor. Aenean pretium libero eget aliquet tristique. Nullam lobortis sed felis ut porttitor. Nullam ornare convallis magna, ut pellentesque felis hendrerit ac. Proin quis eros dictum eros commodo volutpat vitae eu leo. Sed quis congue diam, eget pellentesque odio. Morbi sed vestibulum ligula. Fusce id varius sem, id tempor leo. Curabitur ipsum elit, fringilla nec est nec, venenatis bibendum lorem. Nulla rutrum justo eleifend vulputate vulputate. Aliquam ornare sed lorem ut scelerisque. Nam mi justo, vehicula ut pellentesque eget, fermentum eget lorem.
        @endif
    </div>


    @foreach($errors->get('body') as $message)
        <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
    @endforeach


    <div class="modal-footer">
        <button class="btn btn-success" id="form-submit"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        <a href="{{action('PostController@index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
    </div>

@stop