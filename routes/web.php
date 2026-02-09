<?php

use App\Http\Controllers\CiclistaController;

Route::get('/', [CiclistaController::class, 'index'])->name('ciclista.index');
Route::get('/login', [CiclistaController::class, 'login'])->name('ciclista.login');
