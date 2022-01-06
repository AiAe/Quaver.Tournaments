<?php

namespace App\Http\Controllers\Mappool;

use App\Http\Controllers\Controller;
use App\Models\Mapsuggestion;
use App\Rules\MapStageValidation;
use App\Rules\MapTypeValidation;
use App\Rules\MapValidation;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MappoolController extends Controller
{
    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Mappool";

        return view('mappool/mappool', $pageData);
    }

    public function suggest_map()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Map Suggestion";

        return view('mappool/suggestion', $pageData);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'map' => ['required', new MapValidation()],
            'type' => ['required', new MapTypeValidation()],
            'stage' => ['required', new MapStageValidation()],
            'additional_information' => 'nullable'
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $map = Mapsuggestion::fetchMap($validated['map'])['map'];

        Mapsuggestion::create([
            'user_id' => Auth::user()->id,
            'map_id' => $map['id'],
            'map_type' => $validated['type'],
            'intended_stage' => $validated['stage'],
            'additional_information' => $validated['additional_information'] ?? null,
            'map' => $map
        ]);

        return back()->with('success', 'You successfully submitted map suggestion!');
    }
}
