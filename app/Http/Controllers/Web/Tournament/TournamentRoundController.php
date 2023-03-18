<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentStageRound;
use Illuminate\Http\Request;

class TournamentRoundController extends Controller
{
    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Tournament $tournament, TournamentStageRound $round)
    {
        // TODO: eager load staff for schedule once implemented
        $round->load('matches', 'maps.map');
        return view('web.tournaments.rounds.show', [
            'tournament' => $tournament,
            'round' => $round,
        ]);
    }

    public function edit(TournamentStageRound $round)
    {
    }

    public function update(Request $request, TournamentStageRound $round)
    {
    }

    public function destroy(TournamentStageRound $round)
    {
    }
}
