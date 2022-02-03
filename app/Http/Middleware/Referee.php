<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use View;

class Referee
{
    public function handle(Request $request, Closure $next) {
        $user = Auth::user();
        // Verify permissions
        if (!($user['role'] >= 2)) {
            abort(403);
        }

        View::share('loggedUser', $user);

        return $next($request);
    }
}
