<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', [StudentController::class, 'insertform']);
Route::post('/create', [StudentController::class, 'insert']);
Route::get('/view-records', [StudentController::class, 'index']);

Route::get('/edit/{id}', [StudentController::class, 'show']);
Route::post('/edit/{id}', [StudentController::class, 'edit']);

Route::get('/delete-records',[StudentController::class, 'indexDelete']);
Route::get('/delete/{id}', [StudentController::class, 'destroy']);