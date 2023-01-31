<?php

namespace App\Http\Controllers\Web\Tournaments\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentTeamsController extends Controller
{
    public function index(Tournament $tournament)
    {
        return view('web.tournaments.teams.index', compact('tournament'));
    }

    public function show(Tournament $tournament, Team $team)
    {
        return view('web.tournaments.teams.show', compact('tournament', 'team'));
    }

    public function edit(Team $team)
    {
    }

    public function update(Request $request, Team $team)
    {
    }

    public function destroy(Team $team)
    {
    }
}
