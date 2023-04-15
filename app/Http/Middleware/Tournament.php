<?php

namespace App\Http\Middleware;

use App\Models\TournamentStaff;
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
        $staffList = false;

        // Check if logged user is in team
        if ($tournament) {
            if ($loggedUser) {
                $team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id);

                if ($team) {
                    $loggedUserTeam = $team;
                    $loggedUserTeamCaptain = $team->captain()->is($loggedUser);
                }
            }

            $staffList = TournamentStaff::query()
                ->select(['tournament_id', 'staff_role', 'user_id'])
                ->with(['user' => function ($query) {
                    $query->select(['id', 'username']);
                }])
                ->where('tournament_id', $tournament->id)
                ->get()->pluck('user.username', 'user_id');
        }

        // Accessed with $name
        View::share('tournament', $tournament);
        View::share('loggedUserTeam', $loggedUserTeam);
        View::share('loggedUserTeamCaptain', $loggedUserTeamCaptain);
        View::share('tournamentStaffList', $staffList);
        // Accessed with app('name')
        app()->instance('tournament', $tournament);
        app()->instance('loggedUserTeam', $loggedUserTeam);
        app()->instance('loggedUserTeamCaptain', $loggedUserTeamCaptain);
        app()->instance('tournamentStaffList', $staffList);

        return $next($request);
    }
}
