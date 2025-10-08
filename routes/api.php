<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::post('/midtrans/callback', [TokenController::class, 'callback']);
