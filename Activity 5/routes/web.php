<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathController; //pagdeklara ng Controllers

//Ruta para maipalabas sa url ang mga ginamit sa MathController.php
Route::get('{operation1}/{val1}/{val2}/{operation2}/{val3}/{val4}', [MathController::class, 'compute']);

?>