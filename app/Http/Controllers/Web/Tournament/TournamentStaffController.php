<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentStaffController extends Controller
{
    public function index(Tournament $tournament)
    {
        $title = __('Staff');

        return view('web.tournament.staff.index', ['title' => $title, 'tournament' => $tournament]);
    }

    public function create(Tournament $tournament, Team $team)
    {
    }

    public function store(Tournament $tournament, Team $team)
    {
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
}
