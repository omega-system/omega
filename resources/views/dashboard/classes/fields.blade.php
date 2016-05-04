<div class="ui error message">
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
</div>
<div class="field {{ set_error($errors->has('trimester_id')) }}">
    <label>学期</label>
    <select name="trimester_id" class="ui dropdown">
        @foreach ($trimesters as $trimester)
            @if (old('trimester_id') == $trimester->id)
                <option value="{{ $trimester->id }}" selected>{{ $trimester->trimester_name }}</option>
            @else
                <option value="{{ $trimester->id }}">{{ $trimester->trimester_name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="field {{ set_error($errors->has('course_number')) }}">
    <label>课程</label>
    <select name="course_number" class="ui search dropdown">
        @foreach ($courses as $course)
            @if (old('course_number', $class->course_number) == $course->course_number)
                <option value="{{ $course->course_number }}" selected>
                    {{ $course->course_number }} {{ $course->course_name }}
                </option>
            @else
                <option value="{{ $course->course_number }}">
                    {{ $course->course_number }} {{ $course->course_name }}
                </option>
            @endif
        @endforeach
    </select>
</div>
<div class="field {{ set_error($errors->has('class_number')) }}">
    <label>班级号</label>
    <input type="text" name="class_number" value="{{ old('class_number', $class->class_number) }}">
</div>
<div class="field {{ set_error($errors->has('teacher_id')) }}">
    <label>教师</label>
    <select name="teacher_id" class="ui search dropdown">
        @foreach ($teachers as $teacher)
            @if (old('teacher_id') == $teacher->id)
                <option value="{{ $teacher->id }}" selected>
                    {{ $teacher->number }} ({{ $teacher->name }})
                </option>
            @else
                <option value="{{ $teacher->id }}">
                    {{ $teacher->number }} ({{ $teacher->name }})
                </option>
            @endif
        @endforeach
    </select>
</div>
<div class="field {{ set_error($errors->has('location')) }}">
    <label>教室</label>
    <input type="text" name="location" value="{{ old('location', $class->location) }}">
</div>
