@extends('layouts.master')
@section('header')
    <h2>User Registration:</h2>
@stop

@section('content')
    {{Form::open(array('action'=>'UserController@handleRegister'))}}
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your desired username">
        @foreach($errors->get('username') as $message)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address">
        @foreach($errors->get('email') as $message)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password Confirmation:</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter your password again">
        @foreach($errors->get('password') as $message)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>{{ $message }}</div>
        @endforeach
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Register</button>
    </div>
    {{Form::close()}}
@stop