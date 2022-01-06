<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Form;

class StaffController extends Controller
{
    public function applications()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Map suggestions";

        $pageData['applications'] = Form::query()->where('type', Form::TYPE['staff'])
            ->where('status', Form::STATUS['new'])
            ->orderBy('created_at', 'desc')->paginate(50);

        return view('admin/staff/staff', $pageData);
    }
}
