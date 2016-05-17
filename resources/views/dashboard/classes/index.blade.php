@extends('layouts.app')

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="three wide">学期</th>
            <th class="two wide">课程号</th>
            <th class="two wide">课程名称</th>
            <th class="two wide">班级号</th>
            <th class="two wide">教师</th>
            <th class="two wide">教室</th>
            <th class="right aligned three wide">
                @permission('create.classes')
                <a class="primary ui icon button" href="{{ route('dashboard.classes.create') }}">
                    <i class="plus icon"></i>
                    创建新班级
                </a>
                @endpermission
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td>{{ $class->trimester->trimester_name }}</td>
                <td>{{ $class->course->course_number }}</td>
                <td>{{ $class->course->course_name }}</td>
                <td>{{ $class->class_number }}</td>
                <td>{{ $class->teacher->name }} ({{ $class->teacher->number }})</td>
                <td>{{ $class->location }}</td>
                <td class="right aligned">
                    @permission('create.classes')
                    <a class="ui button" href="{{ route('dashboard.classes.edit', $class->id) }}">编辑</a>
                    @endpermission
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                {!! $presenter->links() !!}
            </td>
        </tr>
        </tfoot>
    </table>
@endsection
