@extends('layouts.app')

@section('content')
    <h2 class="ui header">系统设置</h2>

    <form class="ui form" method="post" action="{{ route('dashboard.system.store') }}">
        {!!  csrf_field() !!}
        {!!  method_field('put') !!}
        <div class="field">
            <label>选课设置</label>
            <div class="ui toggle checkbox">
                @if ($system->allowEnrollment())
                    <input type="checkbox" name="allow_enrollment" checked>
                @else
                    <input type="checkbox" name="allow_enrollment">
                @endif
                <label>允许选课</label>
            </div>
        </div>
        <div class="field">
            <label>退课设置</label>
            <div class="ui toggle checkbox">
                @if ($system->allowWithdrawal())
                    <input type="checkbox" name="allow_withdrawal" checked>
                @else
                    <input type="checkbox" name="allow_withdrawal">
                @endif
                <label>允许退课</label>
            </div>
        </div>
        <div class="field">
            <label>成绩录入设置</label>
            <div class="ui toggle checkbox">
                @if ($system->allowScoreUpdate())
                    <input type="checkbox" name="allow_score_update" checked>
                @else
                    <input type="checkbox" name="allow_score_update">
                @endif
                <label>允许录入成绩</label>
            </div>
        </div>
        <input class="primary ui submit button" type="submit" value="保存">
    </form>
@endsection
