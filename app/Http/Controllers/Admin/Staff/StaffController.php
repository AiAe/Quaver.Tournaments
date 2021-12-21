<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Forms;

class StaffController extends Controller
{
    public function applications()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Map suggestions";

        $pageData['applications'] = Forms::query()->where('type', Forms::TYPE['staff'])
            ->where('status', Forms::STATUS['new'])
            ->orderBy('created_at', 'desc')->paginate(50);

        return view('admin/staff/staff', $pageData);
    }
}
