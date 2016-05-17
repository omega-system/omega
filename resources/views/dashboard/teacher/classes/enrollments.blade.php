@extends('layouts.app')

@section('content')
    <h2 class="ui header">{{ $class->course->course_name }} - {{ $class->class_number }}</h2>

    <table class="ui table">
        <thead>
        <tr>
            <th class="three column wide">序号</th>
            <th class="three column wide">学号</th>
            <th class="ten column wide">姓名</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($enrollments as $enrollment)
            <?php $no = 1; ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $enrollment->student->number }}</td>
                <td>{{ $enrollment->student->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
