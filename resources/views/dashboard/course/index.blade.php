@extends('layouts.app')

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="three wide">课程号</th>
            <th class="sevem wide">课程名称</th>
            <th class="three wide">学分</th>
            <th class="right aligned three wide">
                @permission('create.courses')
                <a class="primary ui icon button" href="{{ route('dashboard.course.create') }}">
                    <i class="plus icon"></i>
                    创建新课程
                </a>
                @endpermission
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->course_number }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->credit }}</td>
                <td class="right aligned">
                    @permission('create.courses')
                    <a class="ui button" href="{{ route('dashboard.course.edit', $course->course_number) }}">编辑</a>
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
