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
        if (is_numeric($string)) return true;
        return true;
    }
}

if (!function_exists('current_route')) {
    function current_route($open_modal_id = null)
    {
        $current = \Illuminate\Support\Facades\URL::current();

        if ($open_modal_id) {
            $current .= $open_modal_id;
        }

        return $current;
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

function list_utc_offsets(): array
{
    return [
        '-12' => 'UTC -12:00',
        '-11' => 'UTC -11:00',
        '-10' => 'UTC -10:00',
        '-9' => 'UTC -09:00',
        '-8' => 'UTC -08:00',
        '-7' => 'UTC -07:00',
        '-6' => 'UTC -06:00',
        '-5' => 'UTC -05:00',
        '-4' => 'UTC -04:00',
        '-3' => 'UTC -03:00',
        '-2' => 'UTC -02:00',
        '-1' => 'UTC -01:00',
        '0' => 'UTC 00:00',
        '1' => 'UTC 01:00',
        '2' => 'UTC 02:00',
        '3' => 'UTC 03:00',
        '4' => 'UTC 04:00',
        '5' => 'UTC 05:00',
        '6' => 'UTC 06:00',
        '7' => 'UTC 07:00',
        '8' => 'UTC 08:00',
        '9' => 'UTC 09:00',
        '10' => 'UTC 10:00',
        '11' => 'UTC 11:00',
        '12' => 'UTC 12:00',
        '13' => 'UTC 13:00',
        '14' => 'UTC 14:00',
    ];
}
