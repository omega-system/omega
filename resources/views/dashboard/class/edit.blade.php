@extends('layouts.app')

@section('content')
    <h2 class="ui header">编辑 {{ $class->course->course_name }} ({{ $class->course->course_number }})
        {{ $class->class_number }}</h2>
    <form class="ui form {{ set_error($errors->count()) }}" method="post"
          action="{{ route('dashboard.class.update', $class->class_number) }}">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
        @include('dashboard.class.fields')
        <input class="primary ui button" type="submit" value="保存">
        @permission('delete.classes')
        <input class="negative ui button" type="button" value="删除"
               onclick="$('#delete_confirmation').modal('show');">
        @endpermission
    </form>

    <form class="ui modal" id="delete_confirmation" method="post"
          action="{{ route('dashboard.class.destroy', $class->id) }}">
        {!! csrf_field() !!}
        {!! method_field('delete') !!}
        <div class="header">删除确认</div>
        <div class="content">
            <div class="ui header">删除班级</div>
            <p>确定删除 {{ $class->course->course_name }} ({{ $class->course->course_number }})
                {{ $class->class_number }} 吗？这将删除所有相关信息，包括该班级相关的选课信息、学生成绩。</p>
        </div>
        <div class="actions">
            <div class="ui black deny button">取消</div>
            <button type="submit" class="ui negative button">删除</button>
        </div>
    </form>
@endsection
