@extends('layouts.app')

@section('content')
    <h2 class="ui header">编辑 {{ $course->course_name }}</h2>
    <form class="ui form {{ set_error($errors->count()) }}" method="post"
          action="{{ route('dashboard.courses.update', $course->course_number) }}">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
        @include('dashboard.courses.fields')
        <input class="primary ui button" type="submit" value="保存">
        @permission('delete.courses')
        <input class="negative ui button" type="button" value="删除"
               onclick="$('#delete_confirmation').modal('show');">
        @endpermission
    </form>

    <form class="ui modal" id="delete_confirmation" method="post"
          action="{{ route('dashboard.courses.destroy', $course->course_number) }}">
        {!! csrf_field() !!}
        {!! method_field('delete') !!}
        <div class="header">删除确认</div>
        <div class="content">
            <div class="ui header">删除课程</div>
            <p>确定删除 {{ $course->course_name }} 吗？这将删除 {{ $course->course_name }}
                的所有相关信息，包括该课程的所有班级和选课信息、学生成绩。</p>
        </div>
        <div class="actions">
            <div class="ui black deny button">取消</div>
            <button type="submit" class="ui negative button">删除</button>
        </div>
    </form>
@endsection
