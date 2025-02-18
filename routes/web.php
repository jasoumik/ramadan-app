<?php

use App\Http\Controllers\PrayerTimeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PrayerTimeController::class, 'index']);
