<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TechController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:DEV'])->group(function () {
    Route::get('/dev/dashboard', [TechController::class, 'index'])->name('tech.dashboard');
});

Route::middleware(['auth', 'role:CLIENT'])->group(function () {
    Route::get('/cliente/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
});
