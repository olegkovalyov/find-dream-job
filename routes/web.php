<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');
    Route::resource('/jobs', JobController::class);
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])
        ->name('bookmarks.index');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])
        ->name('bookmarks.store');
    Route::delete('/bookmarks}', [BookmarkController::class, 'destroy'])
        ->name('bookmarks.destroy');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])
        ->name('applicant.store');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
