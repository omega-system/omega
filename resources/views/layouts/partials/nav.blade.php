<div class="ui tabular menu">
    <div class="ui container">
        <a class="{{ set_active_route('dashboard.index') }} item" href="{{ route('dashboard.index') }}">基本信息</a>
        @permission('create.users|delete.users')
        <a class="{{ set_active_route('dashboard.user.*') }} item" href="{{ route('dashboard.user.index') }}">用户管理</a>
        @endpermission
        @permission('create.trimesters|delete.trimesters')
        <a class="{{ set_active_route('dashboard.trimester.*') }} item" href="{{ route('dashboard.trimester.index') }}">学期管理</a>
        @endpermission
    </div>
</div>
