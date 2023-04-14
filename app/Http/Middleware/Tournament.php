<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use View;

class Tournament
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tournament = $request->route()->parameter('tournament');
        $loggedUser = app('loggedUser');

        $loggedUserTeam = null;
        $loggedUserTeamCaptain = null;

        // Check if logged user is in team
        if ($tournament && $loggedUser) {
            $team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id);

            if ($team) {
                $loggedUserTeam = $team;
                $loggedUserTeamCaptain = $team->captain()->is($loggedUser);
            }
        }

        // Accessed with $name
        View::share('tournament', $tournament);
        View::share('loggedUserTeam', $loggedUserTeam);
        View::share('loggedUserTeamCaptain', $loggedUserTeamCaptain);
        // Accessed with app('name')
        app()->instance('tournament', $tournament);
        app()->instance('loggedUserTeam', $loggedUserTeam);
        app()->instance('loggedUserTeamCaptain', $loggedUserTeamCaptain);

        return $next($request);
    }
}
