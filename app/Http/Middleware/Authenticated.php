<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use View;

class Authenticated
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
        $user = Auth::user();

        View::share('loggedUser', $user);
        app()->instance('loggedUser', $user);

        return $next($request);
    }
}
