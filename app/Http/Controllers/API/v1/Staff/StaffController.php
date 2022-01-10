<?php

namespace App\Http\Controllers\API\v1\Staff;

use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function staff()
    {
        return \App\Http\Controllers\Staff\StaffController::fetchStaff();
    }
}
