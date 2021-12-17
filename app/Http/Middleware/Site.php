<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Site
{
    public function handle(Request $request, Closure $next) {
        if(isset(Auth::user()->id)) {
            View::share('loggedUser', Auth::user());
        }

        return $next($request);
    }
}
