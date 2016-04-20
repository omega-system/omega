@extends('layouts.app')

@section('content')
    <h2 class="ui header">编辑 {{ $user->name }} 的个人信息</h2>
    <form class="ui form {{ set_error($errors->count()) }}" method="post"
          action="{{ route('dashboard.user.update', $user->id) }}">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
        @include('dashboard.user.fields')
        <input class="primary ui button" type="submit" value="保存">
        @if ($user->deletable)
            <input class="negative ui button" type="button" value="删除"
                   onclick="$('#delete_confirmation').modal('show');">
        @endif
    </form>

    <form class="ui modal" id="delete_confirmation" method="post"
          action="{{ route('dashboard.user.destroy', $user->id) }}">
        {!! csrf_field() !!}
        {!! method_field('delete') !!}
        <div class="header">删除确认</div>
        <div class="content">
            <div class="ui header">删除用户</div>
            <p>确定删除用户 {{ $user->name }} ({{ $user->number }}) 吗？</p>
        </div>
        <div class="actions">
            <div class="ui black deny button">取消</div>
            <button type="submit" class="ui negative button">删除</button>
        </div>
    </form>
@endsection
