<?php

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    ->middleware(['auth:sanctum', 'can:view,tournament'])
    ->group(function () {
        Route::get('/', fn(Tournament $tournament) => $tournament);
        Route::get('/teams', fn(Tournament $tournament) => $tournament->load('teams.members')->teams);
        Route::get('/stages', fn(Tournament $tournament) => $tournament->load('stages.rounds.maps', 'stages.rounds.matches')->stages);
    });
