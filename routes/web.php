<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\VotingController;


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', [GoogleAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('/voting/welcome', function () {
    return view('voting.welcome');
})->middleware('auth')->name('voting.welcome');

Route::get('/voting', [VotingController::class, 'index'])
    ->middleware(['auth', 'check.has.voted'])->name('voting.page');

Route::post('/voting', [VotingController::class, 'submit'])
    ->middleware(['auth', 'check.has.voted'])->name('voting.submit');

Route::get('/voting/success/{id}', [VotingController::class, 'success'])
    ->middleware(['auth', 'check.has.voted'])
    ->name('voting.success');

Route::get('/voting/already', function () {
    return view('voting.already');
})->middleware('auth')->name('voting.already');
