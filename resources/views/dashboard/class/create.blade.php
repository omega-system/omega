@extends('layouts.app')

@section('content')
    <h2 class="ui header">创建新班级</h2>
    <form class="ui form {{ set_error($errors->count()) }}" method="post"
          action="{{ route('dashboard.class.store') }}">
        {!! csrf_field() !!}
        @include('dashboard.class.fields')
        <input class="primary ui button" type="submit" value="保存">
    </form>
@endsection
