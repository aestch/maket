<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPaketController;

Route::get('/', function () {
    return view('login.index');
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard', DashboardPaketController::class)->middleware('auth');
Route::resource('/dashboard/paket', DashboardPaketController::class);