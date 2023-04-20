<?php

namespace App\Http\Middleware;

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
        $tournament = $request->route()->parameter('tournament', false);
        $loggedUser = app('loggedUser');

        $loggedUserTeam = false;
        $loggedUserTeamCaptain = false;
        $loggedUserCan = [];

        // Check if logged user is in team
        if ($tournament) {
            if ($loggedUser) {
                $team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id);

                if ($team) {
                    $loggedUserTeam = $team;
                    $loggedUserTeamCaptain = $team->captain()->is($loggedUser);
                }
                // Manage staff permissions
                $loggedUserCan['organizer'] = $tournament->userIsOrganizer($loggedUser);
                $loggedUserCan['head_referee'] = $tournament->userIsHeadReferee($loggedUser);
                $loggedUserCan['head_streamer'] = $tournament->userIsHeadStreamer($loggedUser);
                $loggedUserCan['referee'] = $tournament->userIsReferee($loggedUser);
                $loggedUserCan['streamer'] = $tournament->userIsStreamer($loggedUser);
                $loggedUserCan['commentator'] = $tournament->userIsCommentator($loggedUser);
            }
        }

        // Accessed with $name
        View::share('tournament', $tournament);
        View::share('loggedUserTeam', $loggedUserTeam);
        View::share('loggedUserTeamCaptain', $loggedUserTeamCaptain);
        View::share('loggedUserCan', $loggedUserCan);
        // Accessed with app('name')
        app()->instance('tournament', $tournament);
        app()->instance('loggedUserTeam', $loggedUserTeam);
        app()->instance('loggedUserTeamCaptain', $loggedUserTeamCaptain);
        app()->instance('loggedUserCan', $loggedUserCan);

        return $next($request);
    }
}
