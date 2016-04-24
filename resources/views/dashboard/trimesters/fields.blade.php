<div class="ui error message">
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
</div>
<div class="field {{ set_error($errors->has('year')) }}">
    <label>学年</label>
    <input type="number" name="year" value="{{ old('year', $trimester->year) }}">
</div>
<div class="field {{ set_error($errors->has('sequence')) }}">
    <label>顺序号</label>
    <input type="number" name="sequence" value="{{ old('sequence', $trimester->sequence) }}">
</div>
<div class="field {{ set_error($errors->has('trimester_name')) }}">
    <label>学期名称</label>
    <input type="text" name="trimester_name" value="{{ old('trimester_name', $trimester->trimester_name) }}">
</div>
