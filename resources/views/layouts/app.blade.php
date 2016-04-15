<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>omega 教务管理系统</title>
    <link href="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            background-color: #FFFFFF;
        }

        .ui.menu .item img.logo {
            margin-right: 1.5em;
        }

        .main.container {
            margin-top: 7em;
        }

        .wireframe {
            margin-top: 2em;
        }

        .ui.footer.segment {
            margin: 5em 0em 0em;
            padding: 5em 0em;
        }
    </style>
</head>
<body>
<div class="page header">
    <div class="ui container">
        <div class="ui right floated menu text">
            @if (auth()->user())
                <a class="item" href="{{ route('logout') }}">退出</a>
            @else
                <a class="item" href="{{ route('login') }}">登录</a>
            @endif
        </div>
        <div class="ui menu icon text">
            <a href="{{ route('home') }}" class="header item">
                <img class="logo" src="{{ asset('images/logo.png') }}">
            </a>
        </div>
    </div>
</div>
<div class="page content">
    <div class="ui tabular menu">
        <div class="ui container">
            <a class="active item">仪表盘</a>
        </div>
    </div>
</div>
<div class="ui main text container">
    @yield('content')
</div>
<script src="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.js"></script>
</body>
</html>
