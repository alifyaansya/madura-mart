<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/tes', function () {
//     return view('tes');
// });
Route::get('/table', function () {
    return view('table');
});
Route::resource('dashboard' , DashboardController::class);
Route::resource('distributor' , DistributorController::class);
Route::resource('products' , ProductController::class);
