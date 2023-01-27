<?php

namespace App\Http\Controllers\Web;

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

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Tournament $tournament)
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
