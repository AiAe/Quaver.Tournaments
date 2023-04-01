<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{

    public function view()
    {
        return view('web.home.home', [
            'SEOData' => new SEOData(
                title: 'Home',
                description: '',
            ),
        ]);
    }

}
