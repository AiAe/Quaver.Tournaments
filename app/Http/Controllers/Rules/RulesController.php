<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\Controller;

class RulesController extends Controller
{
    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Rules";

        return view('rules.rules', $pageData);
    }
}
