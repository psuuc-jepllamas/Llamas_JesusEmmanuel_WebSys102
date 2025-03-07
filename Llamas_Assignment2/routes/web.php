<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer/{custid}/{name}/{address}', [ActivityController::class, 'customerMethod']);
Route::get('/item/{itemno}/{name}/{price}', [ActivityController::class, 'itemMethod']);
Route::get('/order/{custid}/{name}/{orderno}/{date}', [ActivityController::class, 'orderMethod']);
Route::get('/orderdetails/{transno}/{orderno}/{itemid}/{name}/{price}/{qty}', [ActivityController::class, 'orderdetailsMethod']);