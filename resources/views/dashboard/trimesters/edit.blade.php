@extends('layouts.app')

@section('content')
    <h2 class="ui header">编辑 {{ $trimester->trimester_name }}</h2>
    <form class="ui form {{ set_error($errors->count()) }}" method="post"
          action="{{ route('dashboard.trimesters.update', $trimester->id) }}">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
        @include('dashboard.trimesters.fields')
        <input class="primary ui button" type="submit" value="保存">
        @permission('delete.trimesters')
        <input class="negative ui button" type="button" value="删除"
               onclick="$('#delete_confirmation').modal('show');">
        @endpermission
    </form>

    <form class="ui modal" id="delete_confirmation" method="post"
          action="{{ route('dashboard.trimesters.destroy', $trimester->id) }}">
        {!! csrf_field() !!}
        {!! method_field('delete') !!}
        <div class="header">删除确认</div>
        <div class="content">
            <div class="ui header">删除学期</div>
            <p>确定删除 {{ $trimester->trimester_name }} 吗？这将删除 {{ $trimester->trimester_name }}
                的所有相关信息，包括该学期开设的课程、班级和选课信息。</p>
        </div>
        <div class="actions">
            <div class="ui black deny button">取消</div>
            <button type="submit" class="ui negative button">删除</button>
        </div>
    </form>
@endsection
