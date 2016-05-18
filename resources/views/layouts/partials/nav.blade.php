<div class="ui tabular menu">
    <div class="ui container">
        <a class="{{ set_active_route('dashboard.index') }} item" href="{{ route('dashboard.index') }}">基本信息</a>
        @role('admin')
        <a class="{{ set_active_route('dashboard.system.*') }} item"
           href="{{ route('dashboard.system.index') }}">系统设置</a>
        @endrole
        @permission('create.users|delete.users')
        <a class="{{ set_active_route('dashboard.users.*') }} item" href="{{ route('dashboard.users.index') }}">用户管理</a>
        @endpermission
        @permission('create.trimesters|delete.trimesters')
        <a class="{{ set_active_route('dashboard.trimesters.*') }} item"
           href="{{ route('dashboard.trimesters.index') }}">学期管理</a>
        @endpermission
        @permission('create.courses|delete.courses')
        <a class="{{ set_active_route('dashboard.courses.*') }} item"
           href="{{ route('dashboard.courses.index') }}">课程管理</a>
        @endpermission
        @permission('create.classes|delete.classes')
        <a class="{{ set_active_route('dashboard.classes.*') }} item"
           href="{{ route('dashboard.classes.index') }}">班级管理</a>
        @endpermission
        @role('teacher')
        <a class="{{ set_active_route('dashboard.teacher.classes.*') }} item"
           href="{{ route('dashboard.teacher.classes.index') }}">我的班级</a>
        @endrole
        @role('student')
        <a class="{{ set_active_route('dashboard.student.classes') }} item"
           href="{{ route('dashboard.student.classes') }}">我的课程</a>
        @if (allow_enrollment() || allow_withdrawal())
            <a class="{{ set_active_route('dashboard.student.enrollment') }} item"
               href="{{ route('dashboard.student.enrollment') }}">选课管理</a>
        @endif
        @endrole
    </div>
</div>
