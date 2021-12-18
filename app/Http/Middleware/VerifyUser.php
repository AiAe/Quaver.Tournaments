<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth()->user()) return redirect(route('oauth', 'quaver'));
        if (Auth()->user() && empty(Auth()->user()->discord_user_id)) return redirect(route('oauth', 'discord'));

        return $next($request);
    }
}
