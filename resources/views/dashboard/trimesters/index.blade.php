@extends('layouts.app')

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="three wide">学年</th>
            <th class="three wide">顺序号</th>
            <th class="four wide">学期名称</th>
            <th class="right aligned six wide">
                @permission('create.trimesters')
                <a class="primary ui icon button" href="{{ route('dashboard.trimesters.create') }}">
                    <i class="plus icon"></i>
                    创建新学期
                </a>
                @endpermission
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($trimesters as $trimester)
            <tr>
                <td>{{ $trimester->year }}</td>
                <td>{{ $trimester->sequence }}</td>
                <td>
                    @if ($trimester->is_current)
                        <div class="ui blue label">当前学期</div>
                    @endif
                    {{ $trimester->trimester_name }}
                </td>
                <td class="right aligned">
                    @permission('create.trimesters')
                    <a class="ui button" href="{{ route('dashboard.trimesters.edit', $trimester->id) }}">编辑</a>
                    @unless ($trimester->is_current)
                        <a class="ui button" href="{{ route('dashboard.trimesters.set_as_current', $trimester->id) }}">设为当前学期</a>
                    @endunless
                    @endpermission
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                {!! $presenter->links() !!}
            </td>
        </tr>
        </tfoot>
    </table>
@endsection
