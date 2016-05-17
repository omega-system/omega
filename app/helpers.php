<?php
use Omega\Trimester;

function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}

function set_active_route($route, $active = 'active')
{
    return str_is($route, Request::route()->getName()) ? $active : '';
}

function set_error($condition, $error = 'error')
{
    return $condition ? $error : '';
}

function set_checked($condition, $checked = 'checked')
{
    return $condition ? $checked : '';
}

function set_disabled($condition, $disabled = 'disabled')
{
    return $condition ? $disabled : '';
}

function get_current_trimester($default = null)
{
    return Trimester::current() ?: $default;
}

function get_current_trimester_id($default = null)
{
    $currentTrimester = get_current_trimester();
    return $currentTrimester ? $currentTrimester->id : $default;
}
