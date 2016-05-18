@extends('layouts.app')

@section('content')
    <h2 class="ui header">选课</h2>

    @if (allow_enrollment())
        <h3>课程查询</h3>
        <div class="ui form">
            <div class="fields">
                <div class="four wide field">
                    <label>课程号</label>
                    <input type="text" id="courseNumber">
                </div>
                <div class="twelve wide field">
                    <label>课程名称</label>
                    <input type="text" id="courseName">
                </div>
            </div>
            <button type="button" class="ui button" id="queryButton">查询</button>
        </div>

        <table id="queryResult" class="ui table" style="display: none;">
            <thead>
            <tr>
                <th class="five wide">课程</th>
                <th class="two wide">班级号</th>
                <th class="three wide">地点</th>
                <th class="two wide">教师</th>
                <th class="four wide"></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    @endif

    <h3>已选课程</h3>
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="three wide">课程</th>
            <th class="two wide">班级号</th>
            <th class="two wide">人数</th>
            <th class="three wide">地点</th>
            <th class="two wide">教师</th>
            <th class="three wide"></th>
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
                <td>{{ $class->teacher->name }}</td>
                <td class="right aligned">
                    @if (allow_withdrawal())
                        <a class="ui button" href="{{ route('dashboard.student.withdrawal', $class->id) }}">退课</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


@section('scripts')
    @if (allow_enrollment())
        <script>
            ~function () {
                var $queryButton = $('#queryButton');
                var $queryResult = $('#queryResult');

                $queryButton.click(function () {
                    var params = {
                        course_number: $('#courseNumber').val(),
                        course_name: $('#courseName').val()
                    };

                    $queryButton.addClass('loading');
                    $queryResult.hide();

                    $.getJSON('{{ route('api.course_classes') }}', params)
                        .then(function (data) {
                            $queryButton.removeClass('loading');

                            $queryResult.find('tbody').html(
                                data.items.map(function (item) {
                                    return '<tr>' +
                                        '   <td>' + item.course_number + ' ' + item.course_name + '</td>' +
                                        '   <td>' + item.class_number + '</td>' +
                                        '   <td>' + item.location + '</td>' +
                                        '   <td>' + item.teacher + '</td>' +
                                        '   <td class="right aligned">' +
                                        '       <a class="primary ui button" href="{{ route('dashboard.student.enrollment') }}' +
                                        '/' + item.id + '">选课</a>' +
                                        '   </td>' +
                                        '</tr>';
                                })
                            );
                            $queryResult.show();
                        });
                });
            }();
        </script>
    @endif
@endsection
