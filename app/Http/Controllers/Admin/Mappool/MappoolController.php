<?php

namespace App\Http\Controllers\Admin\Mappool;

use App\Http\Controllers\Controller;
use App\Models\Mapsuggestion;
use Illuminate\Support\Facades\DB;

class MappoolController extends Controller
{
    public function suggestions()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Map suggestions";

        $pageData['maps'] = Mapsuggestion::query()
            ->select('user_id', 'map_id', 'map_type', 'intended_stage', 'additional_information', 'map', DB::raw('count(map_id) as total'))
            ->groupBy('map_id', 'intended_stage', 'map_type')->orderBy('total', 'desc')->with('user')->paginate(50);

        return view('admin/mappool/suggestions', $pageData);
    }

    public function rounds()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Mappool Rounds";

    }

    public function roundsSave() {

    }
}
