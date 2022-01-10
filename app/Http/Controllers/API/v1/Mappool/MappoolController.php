<?php

namespace App\Http\Controllers\API\v1\Mappool;

use App\Http\Controllers\Controller;
use App\Models\MappoolRound;

class MappoolController extends Controller
{
    public function mappool()
    {
        return MappoolRound::query()
            ->where('status', '=', 1)
            ->with('maps')
            ->get();
    }
}
