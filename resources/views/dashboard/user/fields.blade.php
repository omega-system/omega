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
    <input type="text" name="name" value="{{ old('name', $user->name) }}">
</div>
<div class="field {{ set_error($errors->has('roles')) }}">
    <label>角色</label>
    @foreach ($roles as $role)
        <div>
            <div class="ui checkbox">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                    {{ set_checked($user->roles->contains($role)) }}>
                <label>{{ $role->name }}</label>
            </div>
        </div>
    @endforeach
</div>
<div class="field {{ set_error($errors->has('permissions')) }}">
    <label>权限</label>
    @foreach ($permissions as $permission)
        <div>
            <div class="ui checkbox">
                <input type="checkbox" name="user_permissions[]" value="{{ $permission->id }}"
                    {{ set_checked($user->hasPermission($permission->id)) }}
                    {{ set_disabled($user->rolePermissions()->get()->contains($permission)) }}>
                <label>{{ $permission->name }}</label>
            </div>
        </div>
    @endforeach
</div>
