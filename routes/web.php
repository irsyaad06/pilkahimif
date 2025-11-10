<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\CountController;


Route::get('/login', function () {

    if (auth()->check()) {
        return redirect('/');
    }

    // Jika belum login, tampilkan halaman login
    return view('auth.login');
})->name('login');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');

Route::post('/logout', [GoogleAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('/voting', [VotingController::class, 'index'])
    ->middleware(['auth', 'check.has.voted'])->name('voting.page');

Route::post('/voting', [VotingController::class, 'submit'])
    ->middleware(['auth', 'check.has.voted'])->name('voting.submit');

Route::get('/voting/already', function () {
    return view('voting.already');
})->middleware('auth')->name('voting.already');

Route::get('/', [CountController::class, 'index'])
    ->name('quick.count');
