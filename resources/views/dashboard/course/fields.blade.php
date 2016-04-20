<div class="ui error message">
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
</div>
<div class="field {{ set_error($errors->has('course_number')) }}">
    <label>课程号</label>
    <input type="text" name="course_number" value="{{ old('course_number', $course->course_number) }}">
</div>
<div class="field {{ set_error($errors->has('course_name')) }}">
    <label>课程名</label>
    <input type="text" name="course_name" value="{{ old('course_name', $course->course_name) }}">
</div>
<div class="field {{ set_error($errors->has('credit')) }}">
    <label>学分</label>
    <input type="number" name="credit" value="{{ old('credit', $course->credit) }}">
</div>
