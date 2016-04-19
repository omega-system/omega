<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>omega 教务管理系统</title>
    <link href="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.css" rel="stylesheet">
    <link href="{{ elixir('dist/css/all.css') }}" rel="stylesheet">
</head>
<body>
@include('layouts.partials.header')
<div class="ui main container">
    @yield('content')
</div>
@include('layouts.partials.footer')
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/semantic-ui/2.1.8/semantic.min.js"></script>
<script src="{{ elixir('dist/js/all.js') }}"></script>
</body>
</html>
