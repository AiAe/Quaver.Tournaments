<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Quaver Official Tournament";
        $pageData['seo']['description'] = "Official 4 Keys Tournament Registrations Open!";

        return view('home', $pageData);
    }

}
