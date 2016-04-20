@extends('layouts.app')

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="three wide">学年</th>
            <th class="six wide">顺序号</th>
            <th class="four wide">学期名称</th>
            <th class="right aligned three wide">
                @permission('create.trimesters')
                <a class="primary ui icon button" href="{{ route('dashboard.trimester.create') }}">
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
                <td>{{ $trimester->trimester_name }}</td>
                <td class="right aligned">
                    @permission('create.trimesters')
                    <a class="ui button" href="{{ route('dashboard.trimester.edit', $trimester->id) }}">编辑</a>
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
