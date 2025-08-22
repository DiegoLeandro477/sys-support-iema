<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('auth');

Route::get('/cadastrar', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/cadastrar', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:DEV'])->group(function () {
    Route::get('/dev/dashboard', [DevController::class, 'index'])->name('dev.dashboard');
});

Route::middleware(['auth', 'role:CLIENT'])->group(function () {
    Route::get('/cliente/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

    Route::post('/cliente/ticket/store', [ClientController::class, 'store'])->name('client.ticket.store');
});
