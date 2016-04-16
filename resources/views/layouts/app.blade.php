<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>omega 教务管理系统</title>
    <link href="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.css" rel="stylesheet">
    <link href="{{ elixir('dist/css/all.css') }}" rel="stylesheet">
</head>
<body>
<div class="page header">
    <div class="ui container">
        <div class="ui right floated menu text">
            @if (auth()->check())
                <div class="ui dropdown item">
                    {{ auth()->user()->name }} ({{ auth()->user()->number }})
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="{{ route('logout') }}">退出</a>
                    </div>
                </div>
            @else
                <a class="item" href="{{ route('login') }}">登录</a>
            @endif
        </div>
        <div class="ui menu icon text">
            <a href="{{ route('index') }}" class="header item">
                <img class="logo" src="{{ asset('images/logo.png') }}">
            </a>
        </div>
    </div>
</div>
@if (auth()->check())
    <div class="ui tabular menu">
        <div class="ui container">
            <a class="active item">仪表盘</a>
        </div>
    </div>
@endif
<div class="ui main container">
    @yield('content')
</div>
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.js"></script>
<script src="{{ elixir('dist/js/all.js') }}"></script>
</body>
</html>
