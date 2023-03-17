<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentStage;
use Illuminate\Http\Request;

class TournamentStageController extends Controller
{
    public function index(Tournament $tournament)
    {
        $tournament->load(['stages', 'stages.rounds']);
        return view('web.tournaments.stages.index', ['title' => 'Stages', 'tournaments' => $tournament]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

//    public function show(TournamentStage $tournamentStage)
//    {
//    }

    public function edit(TournamentStage $tournamentStage)
    {
    }

    public function update(Request $request, TournamentStage $tournamentStage)
    {
    }

    public function destroy(TournamentStage $tournamentStage)
    {
    }
}
