<div class="page header">
    <div class="ui navbar menu">
        <div class="ui container">
            <div class="ui menu icon text">
                <a class="item" href="{{ route('index') }}">
                    <div class="item">
                        <img class="logo" src="{{ asset('images/logo.png') }}">
                    </div>
                    <div class="text item">教务管理系统</div>
                </a>
            </div>
            <div class="ui right menu text">
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
        </div>
    </div>
    @if (auth()->check())
        @include('layouts.partials.nav')
    @endif
</div>
