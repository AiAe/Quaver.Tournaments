<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Tournament\TournamentMatchActionsController;
use App\Http\Controllers\Web\Tournament\TournamentMatchController;
use App\Http\Controllers\Web\Tournament\TournamentRoundController;
use App\Http\Controllers\Web\Tournament\TournamentRulesController;
use App\Http\Controllers\Web\Tournament\TournamentsController;
use App\Http\Controllers\Web\Tournament\TournamentStaffController;
use App\Http\Controllers\Web\Tournament\TournamentStageController;
use App\Http\Controllers\Web\Tournament\TournamentTeamsController;
use App\Http\Controllers\Web\User\UserController;
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

// Tournament extensions
Route::middleware(\App\Http\Middleware\Tournament::class)->group(function () {
    Route::prefix('tournaments')->as('tournaments.')->group(function () {
        Route::get('/{tournament}/mappools', [TournamentsController::class, 'mappools'])->name('mappools');
        Route::get('/{tournament}/schedules', [TournamentsController::class, 'schedules'])->name('schedules');
    });

    Route::resource('tournaments', TournamentsController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::singleton('tournaments.rules', TournamentRulesController::class)->only(['show', 'update']);
    Route::resource('tournaments.teams', TournamentTeamsController::class)
        ->only(['index', 'show', 'destroy'])->scoped(['team' => 'slug']);
    Route::resource('tournaments.staff', TournamentStaffController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('tournaments.stages', TournamentStageController::class)->only(['index', 'store', 'destroy']);
    Route::resource('tournaments.rounds', TournamentRoundController::class)->only(['show', 'store', 'destroy']); // TODO: Use slug instead of ID
    Route::resource('tournaments.rounds.match', TournamentMatchController::class)->only(['edit', 'update', 'destroy']);

    Route::singleton('users', UserController::class)->only(['edit', 'update']);
    Route::singleton('users.tournaments', UserTournamentsController::class)->only(['show'])->middleware('auth');
});
