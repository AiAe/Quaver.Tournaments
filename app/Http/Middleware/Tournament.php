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
        $loggedUser = $request->attributes->get('loggedUser');

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

        View::share('tournament', $tournament);
        View::share('loggedUserTeam', $loggedUserTeam);
        View::share('loggedUserTeamCaptain', $loggedUserTeamCaptain);
        $request->attributes->set('tournament', $tournament);
        $request->attributes->set('loggedUserTeam', $loggedUserTeam);
        $request->attributes->set('loggedUserTeamCaptain', $loggedUserTeamCaptain);

        return $next($request);
    }
}
