<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Modules\Auth\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/locations-data', [LocationController::class, 'locations']);
