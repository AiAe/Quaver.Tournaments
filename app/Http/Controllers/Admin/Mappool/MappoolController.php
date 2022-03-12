<?php

namespace App\Http\Controllers\Admin\Mappool;

use App\Http\Controllers\Controller;
use App\Models\Mappool;
use App\Models\MappoolRound;
use App\Models\Mapsuggestion;
use App\Rules\MappoolCategoryValidation;
use App\Rules\MappoolModsValidation;
use App\Rules\MappoolRateValidation;
use App\Rules\MappoolTypeValidation;
use App\Rules\MapValidation;
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

    public function statusPOST(MappoolRound $round)
    {
        $round->status = !$round->status;
        $round->save();

        return back();
    }

    public function roundDelete($id)
    {
        MappoolRound::query()->where('id', '=', $id)->delete();

        return back();
    }

    public function select(MappoolRound $round)
    {
        $pageData[] = "";
        $pageData['seo']['title'] = $round['name'];
        $pageData['round'] = $round;

        $pageData['maps'] = Mappool::query()->where('mappool_round_id', '=', $round['id'])
            ->orderBy('position', 'asc')->get();

        return view('admin/mappool/mappool', $pageData);
    }

    public function selectSave(Request $request)
    {
        $round_id = $request->route()->parameter('round');

        $validator = Validator::make($request->all(), [
            'map' => ['required', new MapValidation()],
            'category' => ['required', new MappoolCategoryValidation()],
            'type' => ['required', new MappoolTypeValidation()],
            'rate' => ['required', new MappoolRateValidation()],
            'mods' => ['required', new MappoolModsValidation()],
            'overwrite_difficulty_rating' => ['nullable', 'numeric'],
            'overwrite_bpm' => ['nullable', 'numeric'],
            'offset' => ['required'],
            'position' => ['required', 'numeric']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $map = Mapsuggestion::fetchMap($validated['map'])['map'];

        // Replace difficulty rating if one is provided
        if(isset($validated['overwrite_difficulty_rating'])) {
            $map['difficulty_rating'] = (float) $validated['overwrite_difficulty_rating'];
        }

        // Replace bpm if one is provided
        if(isset($validated['overwrite_bpm'])) {
            $map['bpm'] = (float) $validated['overwrite_bpm'];
        }

        Mappool::create([
            'mappool_round_id' => $round_id,
            'category' => $validated['category'],
            'type' => $validated['type'],
            'data' => [
                'rate' => $validated['rate'],
                'mods' => $validated['mods'],
                'offset' => $validated['offset'],
            ],
            'map' => $map,
            'position' => $validated['position']
        ]);

        return back();
    }

    public function selectPositionsSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders' => ['required', 'array'],
        ]);

        $validator->validate();
        $validated = $validator->validated();

        foreach ($validated['orders'] as $key => $id) {
            $round = Mappool::query()->where('id', '=', $id);

            $round->update([
                'position' => $key
            ]);
        }

        return 'success';
    }

    public function selectDelete($id)
    {
        Mappool::query()->where('id', '=', $id)->delete();

        return back();
    }
}
