@extends('layouts.app')

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="three wide">学号 / 工号</th>
            <th class="six wide">姓名</th>
            <th class="four wide">角色</th>
            <th class="right aligned three wide">
                @permission('create.users')
                <a class="primary ui icon button" href="{{ route('dashboard.users.create') }}">
                    <i class="plus icon"></i>
                    创建新用户
                </a>
                @endpermission
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->number }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->roles_string }}</td>
                <td class="right aligned">
                    @permission('create.users')
                    <a class="ui button" href="{{ route('dashboard.users.edit', $user->id) }}">编辑</a>
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
