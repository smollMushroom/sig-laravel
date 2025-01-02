<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gempa', function () {
    return view('gempa');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/peta', [PetaController::class, 'index'])->name('peta');
