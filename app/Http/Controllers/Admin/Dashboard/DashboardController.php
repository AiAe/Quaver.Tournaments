<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Dashboard";

        return view('admin/dashboard/dashboard', $pageData);
    }

}
