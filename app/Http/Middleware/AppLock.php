<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use View;

class AppLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.app_lock') === true && !app()->runningInConsole()) {
            if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != config('app.auth_user')
                || $_SERVER['PHP_AUTH_PW'] != config('app.auth_password')) {
                header('WWW-Authenticate: Basic realm="tournaments.quavergame.com"');
                header('HTTP/1.0 401 Unauthorized');
                die('Access Denied');
            }
        }

        return $next($request);
    }
}
