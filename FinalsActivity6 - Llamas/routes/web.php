<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news', [NewsController::class, 'getNews']);
Route::get('/weather', [WeatherController::class, 'getWeather']);
