<?php

namespace App\Http\Controllers\API\v1\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function save(Request $request)
    {
        $data = $request->json()->all();

        var_dump($data);
    }
}
