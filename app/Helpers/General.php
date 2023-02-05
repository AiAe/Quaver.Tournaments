<?php

if (!function_exists('appVersion')) {
    function appVersion(): string
    {
        return match (config('app.env')) {
            'local' => 'dev',
            'testing' => 'test',
            default => config('app.app_version'),
        };
    }
}

if (!function_exists('urlIs')) {
    function urlIs($url)
    {
        return request()->url() === $url ? 'active' : null;
    }
}

if (!function_exists('routeIs')) {
    function routeIs($route, $params = null)
    {
        return request()->routeIs($route, $params) ? 'active' : null;
    }
}

if (!function_exists('routeIsWithin')) {
    function routeIsWithin($route, $params = null)
    {
        return request()->routeIs($route . '*', $params) ? 'active' : null;
    }
}

if (!function_exists('countryFlag')) {
    function countryFlag($flag)
    {
        return asset(sprintf('assets/img/flags/3x2/%s.svg', $flag));
    }
}

if (!function_exists('stringHasValue')) {
    function stringHasValue($string)
    {
        if ($string == null) return false;
        if ($string == "") return false;
        if(is_numeric($string)) return true;
        return true;
    }
}

function createToast($type, $title, $message, $hide = true)
{
    session()->flash('toast', [
        'type' => $type,
        'title' => $title,
        'message' => $message,
        'hide' => $hide
    ]);
}
