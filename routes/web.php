<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('jobs', [JobController::class,'index']);
Route::get('jobs/saved', [JobController::class,'saved']);
Route::get('jobs/create', [JobController::class,'create']);
