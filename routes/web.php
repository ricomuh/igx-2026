<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/pals', fn() => view('coming-soon'))->name('pals');
Route::get('/experiences', fn() => view('coming-soon'))->name('experiences');
Route::get('/guests', fn() => view('coming-soon'))->name('guests');
Route::get('/rundown', fn() => view('coming-soon'))->name('rundown');
Route::get('/exhibitors', fn() => view('coming-soon'))->name('exhibitors');
Route::get('/promo', fn() => view('coming-soon'))->name('promo');
Route::get('/gallery', fn() => view('coming-soon'))->name('gallery');
Route::get('/news', fn() => view('coming-soon'))->name('news');
