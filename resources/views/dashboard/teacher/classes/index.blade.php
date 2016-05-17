@extends('layouts.app')

@section('content')
    <select class="ui dropdown" onchange="location.href = '?trimester=' + this.value;">
        @foreach ($trimesters as $trimester)
            <option {{ $trimester->id === $current_trimester->id ? 'selected' : '' }}
                    value="{{ $trimester->id }}">
                {{ $trimester->trimester_name }}
                @if ($trimester->is_current)
                    (当前学期)
                @endif
            </option>
        @endforeach
    </select>
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="six wide">课程</th>
            <th class="three wide">班级号</th>
            <th class="two wide">人数</th>
            <th class="three wide">地点</th>
            <th class="two wide"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td>{{ $class->course_number }} {{ $class->course->course_name }}</td>
                <td>{{ $class->class_number }}</td>
                <td>{{ $class->enrollments()->count() }}</td>
                <td>{{ $class->location }}</td>
                <td class="right aligned">
                    @permission('create.classes')
                    <a class="ui button" href="{{ route('dashboard.teacher.classes.enrollments', $class->id) }}">查看名单</a>
                    @endpermission
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
