@extends('layouts.app')

@section('content')
    <h2 class="ui header">{{ $class->course->course_name }} - {{ $class->class_number }}</h2>

    <table class="ui table">
        <thead>
        <tr>
            <th class="three column wide">序号</th>
            <th class="three column wide">学号</th>
            <th class="four column wide">姓名</th>
            <th class="two column wide">平时成绩</th>
            <th class="two column wide">考试成绩</th>
            <th class="two column wide">总评成绩</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($enrollments as $enrollment)
            <?php $no = 1; ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $enrollment->student->number }}</td>
                <td>{{ $enrollment->student->name }}</td>
                <td>{{ $enrollment->score_a }}</td>
                <td>{{ $enrollment->score_b }}</td>
                <td>{{ $enrollment->score }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
