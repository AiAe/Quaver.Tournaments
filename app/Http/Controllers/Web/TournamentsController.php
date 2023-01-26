<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tournament;

class TournamentsController extends Controller
{

    public function list()
    {
        $pageData = [];

        $pageData['tournaments'] = Tournament::orderByDesc('id')->paginate(10);

        return view('web.tournaments.list', $pageData);
    }

}
