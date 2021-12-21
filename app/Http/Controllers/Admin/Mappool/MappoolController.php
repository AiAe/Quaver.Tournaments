<?php

namespace App\Http\Controllers\Admin\Mappool;

use App\Http\Controllers\Controller;
use App\Models\Mapsuggestions;
use Illuminate\Support\Facades\DB;

class MappoolController extends Controller
{
    public function suggestions()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Map suggestions";

        $pageData['maps'] = Mapsuggestions::query()
            ->select('user_id', 'map_id', 'map_type', 'intended_stage', 'additional_information', 'map', DB::raw('count(map_id) as total'))
            ->groupBy('map_id', 'intended_stage', 'map_type')->orderBy('total', 'desc')->with('user')->paginate(50);

        return view('admin/mappool/suggestions', $pageData);
    }
}
