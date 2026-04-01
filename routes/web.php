<?php

use App\Http\Controllers\HomeController;
use App\Modules\Auth\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Route::get('/test', [OtpController::class, 'sendOtpTest'])->name('test');
