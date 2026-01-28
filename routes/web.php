<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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