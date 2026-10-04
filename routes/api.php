<?php

use App\Http\Controllers\Api\V1\GameSessionController;
use App\Http\Controllers\Api\V1\ScoreController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('api.v1.')->group(function () {
    // Demo / Standalone Session Parameter (can be disabled in production via GAME_DEMO_ENABLED=false)
    Route::match(['GET', 'POST'], '/game/session', [GameSessionController::class, 'createDemoSession'])->name('game.session');

    // Score submission with encrypted payload (AES-256-CBC)
    Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
});
