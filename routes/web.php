<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('client.dashboard');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('auth');

Route::get('/cadastrar', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/cadastrar', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:DEV'])->group(function () {
    Route::get('/dev/dashboard', [DevController::class, 'index'])->name('dev.dashboard');
    Route::post('/dev/ticket/{id}/update', [DevController::class, 'pullTicket'])->name('dev.ticket.pull');
    Route::post('/dev/ticket/{id}/leave', [DevController::class, 'leaveTicket'])->name('dev.ticket.leave');
    Route::get('/dev/ticket/{id}/details', action: [DevController::class, 'viewTicketDetails'])->name('dev.ticket.details');
});

Route::middleware(['auth', 'role:CLIENT'])->group(function () {
    Route::get('/cliente/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

    Route::post('/cliente/ticket/store', [ClientController::class, 'store'])->name('client.ticket.store');

    Route::get('/cliente/user/update', [ClientController::class, 'updateData'])->name('client.user.update');
    Route::post('/cliente/user/update', [ClientController::class, 'updateDataStore'])->name('client.user.update.store');
});
