<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Tournament\TournamentRulesController;
use App\Http\Controllers\Web\Tournament\TournamentSettingsController;
use App\Http\Controllers\Web\Tournament\TournamentTeamsController;
use App\Http\Controllers\Web\Tournaments\TournamentsController;
use App\Http\Controllers\Web\User\UserTournamentsController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('logout', 'logout')->name('logout');
        Route::get('{driver}', 'redirectToProvider')->name('oauth');
        Route::get('{driver}/callback', 'handleProviderCallback')->name('oauth.callback');
    });

Route::get('/', [HomeController::class, 'view'])->name('home');

Route::resource('tournaments', TournamentsController::class)
    ->only(['index', 'show']);

Route::singleton('tournaments.rules', TournamentRulesController::class)
    ->only(['show', 'update']);

Route::resource('tournaments.teams', TournamentTeamsController::class)
    ->only(['index', 'show'])->scoped([
        'team' => 'slug'
    ]);

Route::singleton('tournaments.settings', TournamentSettingsController::class)
    ->only(['show', 'update']);

Route::singleton('users.tournaments', UserTournamentsController::class)
    ->only(['show']);
