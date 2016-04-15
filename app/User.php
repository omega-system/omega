<?php

namespace Omega;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'number', 'name', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
