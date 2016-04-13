<?php

namespace Omega;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'number';

    protected $fillable = [
        'number', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
