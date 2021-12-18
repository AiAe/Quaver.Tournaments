<?php

namespace App\Http\Controllers\Prizes;

use App\Http\Controllers\Controller;

class PrizesController extends Controller
{
    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Prizes";
        $pageData['seo']['description'] = "Official 4 Keys Tournament Registrations Open!";

        return view('prizes/prizes', $pageData);
    }
}
