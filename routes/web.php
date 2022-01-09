<?php

use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Mappool\MappoolController;
use App\Http\Controllers\Signup\SignupController;
use Illuminate\Support\Facades\Route;


// Auth
Route::get('/oauth/{driver}', [OAuthController::class, 'redirectToProvider'])->name('oauth');
Route::get('/oauth/{driver}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');
Route::get('/logout', [OAuthController::class, 'logout'])->name('logout');

// Pages
Route::get('/mappool', [\App\Http\Controllers\Mappool\MappoolController::class, 'page'])->name('mappool');
Route::get('/players', [\App\Http\Controllers\Players\PlayersController::class, 'page'])->name('players');
Route::get('/rules', [\App\Http\Controllers\Rules\RulesController::class, 'page'])->name('rules');
Route::get('/staff', [\App\Http\Controllers\Staff\StaffController::class, 'page'])->name('staff');

Route::middleware('verify.user')->group(function () {
    Route::get('/mappool/suggestion', [MappoolController::class, 'suggest_map'])->name('mapsSuggestion');
    Route::post('/mappool/suggestion', [MappoolController::class, 'save'])->name('mapsSuggestionPOST');

    Route::get('/signup/staff', [SignupController::class, 'staff'])->name('signupStaff');
    Route::middleware('admin')->get('/signup/player', [SignupController::class, 'player'])->name('signupPlayer');

    Route::post('/signup/staff', [SignupController::class, 'saveStaff'])->name('signupStaffPost');
    Route::post('/signup/player', [SignupController::class, 'savePlayer'])->name('signupPlayerPost');

    Route::middleware('admin')->post('/player/verify', [SignupController::class, 'updatePlayer'])->name('verifyPlayerPost');
});

// Admin
Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'page'])->name('dashboard');

    Route::get('/staff/applications', [App\Http\Controllers\Admin\Staff\StaffController::class, 'applications'])->name('staffApplications');

    Route::prefix('mappool')->as('mappool.')->group(function () {
        Route::get('suggestions', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'suggestions'])->name('suggestions');

        Route::get('rounds', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'rounds'])->name('rounds');
        Route::post('rounds', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'roundsSave'])->name('roundsPOST');

        Route::post('rounds/positions', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'roundsPositionsSave'])->name('rounds.positionsPOST');
        Route::post('rounds/status/{round}', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'statusPOST'])->name('rounds.statusPOST');
        Route::post('rounds/delete/{round}', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'roundDelete'])->name('rounds.deletePOST');

        Route::get('round/{round}', [App\Http\Controllers\Admin\Mappool\MappoolController::class, 'select'])->name('roundSelect');
        Route::post('round/{round}', [\App\Http\Controllers\Admin\Mappool\MappoolController::class, 'selectSave'])->name('roundSelectSave');
        Route::post('round/{round}/positions', [\App\Http\Controllers\Admin\Mappool\MappoolController::class, 'selectPositionsSave'])->name('roundSelectPositionsSave');
        Route::post('round/{round}/delete', [\App\Http\Controllers\Admin\Mappool\MappoolController::class, 'selectDelete'])->name('roundSelectDeletePOST');

    });

    Route::get('/users', [UsersController::class, 'page'])->name('users');
});

// Redirects
Route::get('/quaver/user/{id}', function ($id) {
    return redirect('https://quavergame.com/user/' . $id);
})->name('quaver');

Route::get('/quaver/map/{id}', function ($id) {
    return redirect('https://quavergame.com/mapset/map/' . $id);
})->name('quaverMap');

// Default
Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'page'])->name('home');
