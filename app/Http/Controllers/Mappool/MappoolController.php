<?php

namespace App\Http\Controllers\Mappool;

use App\Http\Controllers\Controller;

class MappoolController extends Controller
{
    public function page()
    {
        $pageData[] = "Mappool";
        $pageData['seo']['title'] = "";
        $pageData['seo']['description'] = "Official 4 Keys Tournament Registrations Open!";

        return view('mappool/mappool', $pageData);
    }
}
