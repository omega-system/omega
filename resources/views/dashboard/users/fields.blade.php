<div class="ui error message">
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
</div>
<div class="field {{ set_error($errors->has('number')) }}">
    <label>学号 / 工号</label>
    <input type="text" name="number" value="{{ old('number', $user->number) }}">
</div>
<div class="field {{ set_error($errors->has('name')) }}">
    <label>姓名</label>
    <input type="password" name="name" value="{{ old('name', $user->name) }}">
</div>
<div class="field {{ set_error($errors->has('password')) }}">
    <label>密码</label>
    <input type="password" name="password">
</div>
<div class="field {{ set_error($errors->has('password_confirmation')) }}">
    <label>确认密码</label>
    <input type="text" name="password_confirmation">
</div>
<h3>角色</h3>
@foreach ($roles as $role)
    <div class="field">
        <div class="ui checkbox">
            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                {{ set_checked($user->roles->contains($role)) }}>
            <label>{{ $role->name }}</label>
        </div>
    </div>
@endforeach
<h3>权限</h3>
@foreach ($permissions as $permission)
    <div class="field">
        <div class="ui checkbox">
            <input type="checkbox" name="user_permissions[]" value="{{ $permission->id }}"
                {{ set_checked($user->hasPermission($permission->id)) }}
                {{ set_disabled($user->rolePermissions()->get()->contains($permission)) }}>
            <label>{{ $permission->name }}</label>
        </div>
    </div>
@endforeach
