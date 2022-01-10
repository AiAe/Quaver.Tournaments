<?php

namespace App\Http\Controllers\API\v1\Players;

use App\Http\Controllers\Controller;
use App\Models\User;

class PlayersController extends Controller
{
    public function players()
    {
        return User::query()
            ->with('player')
            ->has('player')
            ->get();
    }
}
