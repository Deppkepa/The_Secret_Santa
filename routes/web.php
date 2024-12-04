<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretSantaController;
// Route::get('/',[SecretSantaController::class, 'hello'])->name('secret-santa.index');
Route::get('/secret-santa', [SecretSantaController::class, 'index'])->name('secret-santa.index');
Route::post('/secret-santa', [SecretSantaController::class, 'store'])->name('secret-santa.store');
Route::get('/users', [SecretSantaController::class, 'table'])->name('users.table');