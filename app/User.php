<?php

namespace Omega;

use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use HasRoleAndPermission;

    protected $fillable = [
        'number', 'name', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRolesStringAttribute()
    {
        return join(', ', $this->roles()->pluck('name')->toArray());
    }

    public function getDeletableAttribute()
    {
        $user = Auth::user();
        if (!$user || !$user->canDeleteUsers()) return false;
        return ($this->id !== $user->id) && ($this->level() <= $user->level());
    }

    public function courseClasses()
    {
        return $this->hasMany('Omega\CourseClass', 'teacher_id');
    }
    
    public function enrollments()
    {
        return $this->hasMany('Omega\CourseEnrollment');
    }
}

