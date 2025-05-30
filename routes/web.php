<?php

use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/pals', fn() => view('coming-soon'))->name('pals');
Route::get('/experiences', fn() => view('coming-soon'))->name('experiences');
// Route::get('/guests', fn() => view('coming-soon'))->name('guests');
Route::get('/guests', GuestController::class)->name('guests');
Route::get('/rundown', fn() => view('coming-soon'))->name('rundown');
// Route::get('/exhibitors', fn() => view('coming-soon'))->name('exhibitors');
Route::get('/exhibitors', ExhibitorController::class)->name('exhibitors');
Route::get('/promo', fn() => view('coming-soon'))->name('promo');
Route::get('/gallery', fn() => view('coming-soon'))->name('gallery');
Route::as('news.')->prefix('news')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});
Route::get('/privacy-policy', fn() => view('privacy-policy.index'))->name('privacy-policy');
Route::get('/terms-of-service', fn() => view('terms-of-service.index'))->name('terms-of-service');
