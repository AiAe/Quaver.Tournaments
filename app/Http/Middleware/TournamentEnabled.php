<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use View;

class TournamentEnabled
{
    public function handle(Request $request, Closure $next) {
        $user = Auth::user();

        // Check if signups are enabled or user is admin
        if (!config('app.tourney_signups') && $user['role'] !== 100) {
            return redirect(route('signupClosed'));
        }

        View::share('loggedUser', $user);

        return $next($request);
    }
}
