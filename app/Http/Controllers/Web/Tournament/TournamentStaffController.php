<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentStaffController extends Controller
{
    public function index(Tournament $tournament)
    {
        $title = __('Staff');

        return view('web.tournaments.staff.index', ['title' => $title, 'tournaments' => $tournament]);
    }

    public function create(Tournament $tournament)
    {
    }

    public function store(Request $request, Tournament $tournament)
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
