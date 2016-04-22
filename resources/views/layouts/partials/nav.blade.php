<div class="ui tabular menu">
    <div class="ui container">
        <a class="{{ set_active_route('dashboard.index') }} item" href="{{ route('dashboard.index') }}">基本信息</a>
        @permission('create.users|delete.users')
        <a class="{{ set_active_route('dashboard.user.*') }} item" href="{{ route('dashboard.user.index') }}">用户管理</a>
        @endpermission
        @permission('create.trimesters|delete.trimesters')
        <a class="{{ set_active_route('dashboard.trimester.*') }} item" href="{{ route('dashboard.trimester.index') }}">学期管理</a>
        @endpermission
        @permission('create.courses|delete.courses')
        <a class="{{ set_active_route('dashboard.course.*') }} item" href="{{ route('dashboard.course.index') }}">课程管理</a>
        @endpermission
        @permission('create.classes|delete.classes')
        <a class="{{ set_active_route('dashboard.class.*') }} item" href="{{ route('dashboard.class.index') }}">班级管理</a>
        @endpermission
    </div>
</div>
