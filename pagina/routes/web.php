<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name('home');
Route::get('/inscripcion', [RegistroController::class, 'show'])->name('inscripcion');
Route::post('/inscripcion', [RegistroController::class, 'store'])->name('inscripcion.store');
