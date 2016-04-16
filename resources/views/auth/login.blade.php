<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>登录 omega</title>
    <link href="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.css" rel="stylesheet">
    <link href="{{ elixir('dist/css/all.css') }}" rel="stylesheet">
</head>
<body class="login page">
<div class="ui middle aligned center aligned login grid">
    <div class="column">
        <h2 class="ui blue image header">
            <a class="image" href="{{ route('index') }}"><img class="logo" src="{{ asset('images/logo.png') }}"></a>
            <div class="content">登录 omega</div>
        </h2>
        <form class="ui large form" method="post">
            {!! csrf_field() !!}
            <div class="field">
                <div class="ui left icon input">
                    <i class="user icon"></i>
                    <input type="text" class="form-control" maxlength="8" name="number" placeholder="学号 / 工号"
                           value="{{ old('number') }}">
                </div>
            </div>
            <div class="field">
                <div class="ui left icon input">
                    <i class="lock icon"></i>
                    <input type="password" class="form-control" name="password" placeholder="密码">
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="remember_me">
                    <label>记住登录状态</label>
                </div>
            </div>
            <input type="submit" class="ui fluid large primary submit button" value="登录">
        </form>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.js"></script>
<script src="{{ elixir('dist/js/all.js') }}"></script>
</body>
</html>
