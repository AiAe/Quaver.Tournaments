<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Tournaments\TournamentsController;
use App\Http\Controllers\Web\Tournaments\TournamentTeamController;
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

Route::resource('tournaments',TournamentsController::class)
    ->only(['index', 'show']);

Route::resource('tournaments.teams', TournamentTeamController::class)
    ->only(['show']);
