<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/customer',[UserController::class,'storeCustomer']);

Route::post('/staff',[UserController::class,'storeStaff']);
