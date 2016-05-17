@extends('layouts.app')

@section('content')
    <h2 class="ui header">{{ $class->course->course_name }} - {{ $class->class_number }}</h2>

    <h3>成绩录入</h3>

    <form class="ui small form {{ set_error($errors->count()) }}" method="post">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
        <div class="ui error message">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </div>
        <table class="ui table">
            <thead>
            <tr>
                <th class="three column wide">序号</th>
                <th class="three column wide">学号</th>
                <th class="four column wide">姓名</th>
                <th class="three column wide">平时成绩</th>
                <th class="three column wide">考试成绩</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($enrollments as $enrollment)
                <?php $no = 1; ?>
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $enrollment->student->number }}</td>
                    <td>{{ $enrollment->student->name }}</td>
                    <td>
                        <div class="field {{ set_error($errors->has('score_a.' . ($no - 1))) }}">
                            <input type="number" name="score_a[]"
                                   value="{{ old('score_a.' . ($no - 1), $enrollment->score_a) }}">
                        </div>
                    </td>
                    <td>
                        <div class="field {{ set_error($errors->has('score_b.' . ($no - 1))) }}">
                            <input type="number" name="score_b[]"
                                   value="{{ old('score_b.' . ($no - 1), $enrollment->score_b) }}">
                        </div>
                    </td>
                </tr>
                <?php $no++; ?>
            @endforeach
            </tbody>
        </table>
        <input class="submit primary ui button" type="submit" value="保存">
    </form>
@endsection
