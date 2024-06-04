<?php

use App\Models\Tournament;
use App\Models\TournamentMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::githubWebhooks('github-webhook-deploy');

Route::prefix('tournaments/{tournament}')
    ->middleware(['auth:sanctum', 'can:update,tournament'])
    ->group(function () {
        Route::get('/', function (Tournament $tournament) {
            // Unset metas since it contains a lot of private data
            unset($tournament['metas']);

            return $tournament;
        });
        Route::get('/teams', fn(Tournament $tournament) => $tournament->load('teams.members')->teams);
        Route::get('/stages', fn(Tournament $tournament) => $tournament->load('stages.rounds.maps.map',
            'stages.rounds.matches.staff.user')->stages);
        Route::post('/match/{match}', function (Request $request, Tournament $tournament, TournamentMatch $match) {
            $validator = Validator::make($request->all(), [
                'mp_link' => ['nullable'],
                'score1' => ['required', 'numeric'],
                'score2' => ['required', 'numeric'],
            ]);

            $validator->validate();
            $validated = $validator->validated();

            if(isset($validated['mp_link']) && $validated['mp_link']) {
                $mp_id = (int)basename($validated['mp_link']);
                $match->quaver_mp_ids = array_merge($match->quaver_mp_ids??[], [$mp_id]);
            }

            $match->score1 = $validated['score1'];
            $match->score2 = $validated['score2'];

            if($validated['score1'] || $validated['score2']) {
                $match->notified = 1;
            }

            $match->save();

            return "Match updated!";
        });
    });
