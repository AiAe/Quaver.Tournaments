<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Models\Player;

class PlayersController extends Controller
{
    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Players";

        $pageData['players'] = Player::query()->where('status', '!=',  0)->paginate(50);

        return view('players/players', $pageData);
    }
}
