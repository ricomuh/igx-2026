<?php

use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/pals', fn() => view('igx-pals.index'))->name('pals');
Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences');
Route::get('/experiences/leaderboard', [ExperienceController::class, 'leaderboard'])->name('experiences.leaderboard');
Route::get('/guests', GuestController::class)->name('guests');
Route::get('/rundown', fn() => view('coming-soon'))->name('rundown');
Route::get('/exhibitors', ExhibitorController::class)->name('exhibitors');
Route::get('/promo', fn() => view('coming-soon'))->name('promo');
Route::get('/gallery', GalleryController::class)->name('gallery');
Route::as('news.')->prefix('news')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});
Route::get('/privacy-policy', fn() => view('privacy-policy.index'))->name('privacy-policy');
Route::get('/terms-of-service', fn() => view('terms-of-service.index'))->name('terms-of-service');
Route::get('/contact-us', fn() => view('contact-us.index'))->name('contact-us');

// Debug route to verify font fix (bypasses cache)
Route::get('/debug-font', fn() => view('welcome'))->name('debug-font');

// Font CSS as raw CSS (bypasses view cache)
Route::get('/font-css', fn() => response('@font-face{font-family:"Brush King";src:url(/fnt/brush-king.otf) format("opentype");font-weight:normal;font-style:normal}', 200, ['Content-Type' => 'text/css']));

// Font serving with correct MIME type (bypasses Hostinger nosniff + octet-stream)
Route::get('/fnt/{file}', function ($file) {
    $path = public_path("fonts/{$file}");
    if (!file_exists($path)) abort(404);
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mimes = ['otf' => 'font/otf', 'ttf' => 'font/ttf', 'woff' => 'font/woff', 'woff2' => 'font/woff2'];
    return response()->file($path, ['Content-Type' => $mimes[$ext] ?? 'application/octet-stream']);
})->where('file', '.*');
