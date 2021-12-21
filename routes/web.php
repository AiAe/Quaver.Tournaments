<?php

use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Mappool\MappoolController;
use App\Http\Controllers\Signup\SignupController;
use Illuminate\Support\Facades\Route;


// Auth
Route::get('/oauth/{driver}', [OAuthController::class, 'redirectToProvider'])->name('oauth');
Route::get('/oauth/{driver}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');
Route::get('/logout', [OAuthController::class, 'logout'])->name('logout');

// Pages
//Route::get('/mappool', [\App\Http\Controllers\Mappool\MappoolController::class, 'page'])->name('mappool');
//Route::get('/players', [\App\Http\Controllers\Players\PlayersController::class, 'page'])->name('players');
Route::get('/rules', [\App\Http\Controllers\Rules\RulesController::class, 'page'])->name('rules');
Route::get('/staff', [\App\Http\Controllers\Staff\StaffController::class, 'page'])->name('staff');

Route::middleware('verify.user')->group(function () {
    Route::get('/mappool/suggestion', [MappoolController::class, 'suggest_map'])->name('mapsSuggestion');
    Route::post('/mappool/suggestion', [MappoolController::class, 'save'])->name('mapsSuggestionPOST');

    Route::get('/signup/staff', [SignupController::class, 'staff'])->name('signupStaff');
    Route::get('/signup/player', [SignupController::class, 'player'])->name('signupPlayer');

    Route::post('/signup/{type}', [SignupController::class, 'save'])->name('signupPost');
});

// Admin
Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'page'])->name('dashboard');
});

// Redirects
Route::get('/quaver/{id}', function ($id) {
    return redirect('https://quavergame.com/user/' . $id);
})->name('quaver');

// Default
Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'page'])->name('home');
