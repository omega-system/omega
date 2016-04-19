@extends('layouts.app')

@section('content')
    <h2 class="ui header">编辑 {{ $user->name }} 的个人信息</h2>
    <div class="ui grid">
        <div class="four wide column">
            <div class="ui secondary vertical pointing menu">
                <a class="active item">基本信息</a>
            </div>
        </div>
        <div class="twelve wide stretched column">
            <form class="ui form" method="post" action="{{ route('dashboard.user.update', $user->id) }}">
                {!! csrf_field() !!}
                {!! method_field('put') !!}
                <div class="field">
                    <label>学号 / 工号 (不可编辑)</label>
                    <input type="text" readonly value="{{ $user->number }}">
                </div>
                <div class="field">
                    <label>姓名</label>
                    <input type="text" name="name" value="{{ $user->name }}">
                </div>
                <input class="primary ui button" type="submit" value="保存">
            </form>
        </div>
    </div>
@endsection
