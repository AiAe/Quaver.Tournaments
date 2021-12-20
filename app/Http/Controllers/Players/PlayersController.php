<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;

class PlayersController extends Controller
{
    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Players";

        return view('players/players', $pageData);
    }
}
