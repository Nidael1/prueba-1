<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeController;

Route::get('/registros.json', [MensajeController::class, 'registrosJson']);
