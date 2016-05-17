@extends('layouts.app')

@section('content')


<head>{{$class}}</head>

<table class="ui unstackable table" >
    <thead>
    <th class="three wide">学期</th>
    <th class="three wide">课程号</th>
    <th class="three wide">班级号</th>
    <th class="seven wide">地点</th>
    </thead>
    <tbody>
    <tr>
        <td>{{ $class->trimester->trimester_name }}</td>
        <td>{{ $class->course_number }}</td>
        <td>{{ $class->class_number }}</td>
        <td>{{ $class->location }}</td>

    </tr>
    </tbody>
    </thead>
</table>

@endsection
