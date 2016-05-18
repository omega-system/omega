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
            <th class="five wide">课程</th>
            <th class="two wide">班级号</th>
            <th class="two wide">人数</th>
            <th class="four wide">地点</th>
            <th class="two wide">总评成绩</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($enrollments as $enrollment)
            <?php $class = $enrollment->courseClass; ?>
            <tr>
                <td>{{ $class->course_number }} {{ $class->course->course_name }}</td>
                <td>{{ $class->class_number }}</td>
                <td>{{ $class->enrollments()->count() }}</td>
                <td>{{ $class->location }}</td>
                <td>{{ $enrollment->score ?: '暂无' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
