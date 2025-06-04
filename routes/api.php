<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->as('api.v1')->group(function () {
    Route::post('/scores', [App\Http\Controllers\Api\V1\ScoreController::class, 'store']);
});
