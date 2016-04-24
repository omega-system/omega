@extends('layouts.app')

@section('content')
    <h2 class="ui header">创建新课程</h2>
    <form class="ui form {{ set_error($errors->count()) }}" method="post"
          action="{{ route('dashboard.courses.store') }}">
        {!! csrf_field() !!}
        @include('dashboard.courses.fields')
        <input class="primary ui button" type="submit" value="保存">
    </form>
@endsection
