<?php

namespace App\Http\Controllers\Mappool;

use App\Http\Controllers\Controller;
use App\Models\MappoolRound;
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

        $pageData['round'] = MappoolRound::query()->where('status', 1)
            ->orderBy('position', 'desc')->with('maps')->first();

        if ($pageData['round']) {
            $pageData['previous_rounds'] = MappoolRound::query()->where('status', 1)
                ->whereNotIn('id', [$pageData['round']->id])
                ->orderBy('position', 'desc')->with('maps')->get();
        } else {
            $pageData['previous_rounds'] = [];
        }

        return view('mappool/mappool', $pageData);
    }

    public function qualifers_mappool()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Qualifiers Mappool";

        $pageData['maps'] = [
            [
                [
                    'background' => asset('img/qualifiers/sv.png'),
                    'song' => "Morimori Atsushi - Realization [Stage 1: Truth]",
                    "url" => "https://quavergame.com/mapset/map/73468",
                    "type" => "SV",
                    "rating" => "12.43",
                    "length" => "01:59",
                    "bpm" => "140"
                ],
                [
                    'background' => asset('img/qualifiers/tech.jpeg'),
                    'song' => "yvk1n0 - Yukinopapurika [Stage 2: Paranoia]",
                    "url" => "https://quavergame.com/mapset/map/73471",
                    "type" => "Accuracy",
                    "rating" => "24.77",
                    "length" => "01:36",
                    "bpm" => "180"
                ],
            ],
            [
                [
                    'background' => asset('img/qualifiers/ln.jpeg'),
                    'song' => "Sakuzyo - Imprinting [Stage 3: Illuminating]",
                    "url" => "https://quavergame.com/mapset/map/73467",
                    "type" => "LN",
                    "rating" => "25.10",
                    "length" => "01:53",
                    "bpm" => "175"
                ],
                [
                    'background' => asset('img/qualifiers/rice.png'),
                    'song' => "Aoi - γuarδina [Stage 4: Luminescence]",
                    "url" => "https://quavergame.com/mapset/map/73466",
                    "type" => "Rice [Rawskill]",
                    "rating" => "30.47",
                    "length" => "02:05",
                    "bpm" => "202"
                ],
            ]
        ];

        $pageData['download'] = "https://mega.nz/file/3UpW3ZBb#sjaBJ6HPAUwbPrWU9kz4D7OrkgiFohlusUNE3LQNKL8";

        return view('mappool.qualifiers', $pageData);
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
