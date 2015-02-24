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
        <link rel="stylesheet" href="{{asset('/css/base.css')}}">
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">Scaffold</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="/news">News</a></li>
                    </ul>
                </div>
            </nav>





                @yield('header')

            </div>
        <div class="container" id="message-container">
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
        </div>

            @yield('content')
            <div class="modal-footer">
                <p class="text-center text-muted">Design and code copyright Chris Luffingham 2015</p>
            </div>

        @yield('footer')
        <div id="login-box">
            <span class="glyphicon glyphicon-user"></span>
            @if(Auth::check())
                Logged in as <strong>{{{Auth::user()->username}}}</strong>
                {{link_to('logout', 'Logout')}}
            @else
                {{link_to('login', 'Login')}}
            @endif
        </div>
    </body>
</html>