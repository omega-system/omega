@extends('layouts.app')

@section('content')
    <div class="ui middle aligned center aligned login grid">
        <div class="column">
            <h2 class="ui header">用户登录</h2>
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
                <input type="submit" class="ui fluid large primary submit button" value="登录">
            </form>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">

            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">学号 / 工号</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" maxlength="8" name="number" value="{{ old('number') }}">

                    @if ($errors->has('number'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Login
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
