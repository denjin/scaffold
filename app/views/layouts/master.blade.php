<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <title>Web Platform Scaffold</title>
        <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/medium-editor.css')}}">
        <link rel="stylesheet" href="{{asset('/css/medium-editor-insert.css')}}">
        <link rel="stylesheet" href="{{asset('/css/themes/bootstrap.min.css')}}">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="page-header">
                <div class="text-center">
                    <h1>{{link_to('/', 'Web App Scaffold')}}</h1>
                </div>
                <div class="text-right">
                    @if(Auth::check())
                        Logged in as <strong>{{{Auth::user()->username}}}</strong>
                        {{link_to('logout', 'Logout')}}
                    @else
                        {{link_to('login', 'Login')}}
                    @endif
                </div>
                @yield('header')
            </div>
        </div>
        <div class="container">

            @if(Session::has('message'))
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok-circle"></span>{{Session::get('message')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-exclamation-sign"></span>{{Session::get('error')}}
                </div>
            @endif
            @yield('content')
            <div class="modal-footer">
                <p class="text-center text-muted">Design and code copyright Chris Luffingham 2015</p>
            </div>

        @yield('footer')
    </body>
</html>