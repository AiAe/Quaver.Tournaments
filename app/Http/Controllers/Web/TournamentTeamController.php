<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\User;
use App\Notifications\TeamInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentTeamController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tournament::class, 'tournament');
        // ToDo restrict the page only if tournament is team based & when player has/in team
    }

    public function show(Tournament $tournament)
    {
        return view('web.tournaments.team', compact('tournament'));
    }
}
