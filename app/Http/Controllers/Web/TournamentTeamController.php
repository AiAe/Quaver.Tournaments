<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Tournament;

class TournamentTeamController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(Tournament::class, 'tournament');
        // ToDo restrict the page only if tournament is team based & when player has/in team
    }

    public function show(Tournament $tournament, Team $team)
    {
        $team->with(['members']);

        return view('web.tournaments.team', compact('tournament', 'team'));
    }
}
