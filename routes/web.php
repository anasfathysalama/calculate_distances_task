<?php

use App\Http\Controllers\Distance\DistanceController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/get-distances', [DistanceController::class , 'calcGeolocationDistances']);
