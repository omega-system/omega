<?php

function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}

function set_active_route($route, $active = 'active')
{
    return str_is($route, Request::route()->getName()) ? $active : '';
}
