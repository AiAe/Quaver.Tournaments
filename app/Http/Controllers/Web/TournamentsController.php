<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class TournamentsController extends Controller
{

    public function list()
    {
        $pageData = [];

        return view('web.tournaments.list', $pageData);
    }

}
