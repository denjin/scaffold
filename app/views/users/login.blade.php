@extends('layouts.master')
@section('header')
    <h2>Please Log In:</h2>
@stop

@section('content')
    {{Form::open(array('action'=>'UserController@handleLogin'))}}
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Login</button>
    </div>
    {{Form::close()}}
@stop