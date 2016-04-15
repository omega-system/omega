<?php

namespace Omega;

use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use HasRoleAndPermission;

    protected $fillable = [
        'number', 'name', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
