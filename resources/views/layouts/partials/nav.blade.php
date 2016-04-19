<div class="ui tabular menu">
    <div class="ui container">
        <a class="{{ set_active_route('dashboard.index') }} item" href="{{ route('dashboard.index') }}">个人信息</a>
        @permission('create.users|delete.users')
        <a class="{{ set_active_route('dashboard.user.*') }} item" href="{{ route('dashboard.user.index') }}">用户管理</a>
        @endpermission
    </div>
</div>
