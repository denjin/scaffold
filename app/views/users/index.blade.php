@extends('layouts.master')
@section('header')
    {{ Breadcrumbs::render() }}
@stop
@section('content')
    <div class="container">
        @if(Auth::check())
            <div class="row">
            <a href="{{url('register')}}">
                <span class="glyphicon glyphicon-plus"></span>Register a new user
            </a>
            </div>
        @endif
        @foreach($users as $user)
            <div class="row bg-info">
                <p class="text-primary"><a href="{{url('users/'.$user->username)}}">{{{$user->username}}}</a></p>
            </div>
        @endforeach
        <div class="row">
            {{ $users->links() }}
        </div>
    </div>
@stop