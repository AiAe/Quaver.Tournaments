<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentMatch;
use App\Models\TournamentStageRound;
use Illuminate\Http\Request;

class TournamentMatchController extends Controller
{
    public function index(Tournament $tournament, TournamentStageRound $round)
    {
    }

    public function create(Tournament $tournament, TournamentStageRound $round)
    {
    }

    public function store(Request $request)
    {
    }

    public function show(TournamentMatch $match)
    {
    }

    public function edit(TournamentMatch $match)
    {
    }

    public function update(Request $request, TournamentMatch $match)
    {
    }

    public function destroy(TournamentMatch $match)
    {
    }
}
