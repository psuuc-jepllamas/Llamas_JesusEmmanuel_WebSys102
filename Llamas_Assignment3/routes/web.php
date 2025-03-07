<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('activity', [ActivityController::class, 'showData'])->name('activity');
Route::post('activity', [ActivityController::class, 'process']);