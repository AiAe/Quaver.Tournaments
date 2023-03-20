<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tournament::class, 'tournament');
    }

    public function index()
    {
        return view('web.tournaments.index');
    }

    public function show(Tournament $tournament)
    {
        return view('web.tournaments.show', compact('tournament'));
    }

    public function edit(Tournament $tournament)
    {
    }

    public function update(Request $request, Tournament $tournament)
    {
    }

    public function destroy(Tournament $tournament)
    {
    }

    public function mappools(Tournament $tournament)
    {
        return view('web.tournaments.mappools', ['tournament' => $tournament]);
    }

    public function schedules(Tournament $tournament)
    {
        // TODO: eager load staff once implemented
        $tournament->load(['stages.rounds.matches.team1', 'stages.rounds.matches.team2']);
        return view('web.tournaments.schedules', ['tournament' => $tournament]);
    }
}
