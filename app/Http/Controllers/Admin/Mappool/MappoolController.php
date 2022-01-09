<?php

namespace App\Http\Controllers\Admin\Mappool;

use App\Http\Controllers\Controller;
use App\Models\MappoolRound;
use App\Models\Mapsuggestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $pageData['rounds'] = MappoolRound::query()->orderBy('position', 'asc')->get();

        return view('admin/mappool/rounds', $pageData);
    }

    public function roundsSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'position' => ['required']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        MappoolRound::create([
            'name' => $validated['name'],
            'position' => $validated['position']
        ]);

        return back();
    }

    public function roundsPositionsSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders' => ['required', 'array'],
        ]);

        $validator->validate();
        $validated = $validator->validated();

        foreach ($validated['orders'] as $key => $id) {
            $round = MappoolRound::query()->where('id', '=', $id);

            $round->update([
                'position' => $key
            ]);
        }

        return 'success';
    }

    public function roundDelete($id)
    {
        MappoolRound::query()->where('id', '=', $id)->delete();

        return back();
    }
}
