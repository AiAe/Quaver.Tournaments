<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Quaver Official Tournament";

        return view('home', $pageData);
    }

}
