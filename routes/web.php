<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoginController as ControllersLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('login', [ControllersLoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [ControllersLoginController::class, 'authenticate']);
