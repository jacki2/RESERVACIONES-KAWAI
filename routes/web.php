<?php
use App\Http\Controllers\ReservaController;

Route::get('/reservar', [ReservaController::class, 'create'])->name('reservar.create');
Route::post('/reservar', [ReservaController::class, 'store'])->name('reservar.store');
