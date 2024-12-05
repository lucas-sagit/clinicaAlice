<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // Use o LoginController corretamente
use App\Http\Controllers\LoginController as ControllersLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Definir corretamente o controller para as rotas de login
Route::controller(LoginController::class)->group(function() {
    Route::get('login', 'showLoginForm')->name('login.index');
    Route::post('login', 'authenticate')->name('login.store');
    Route::get('logout', 'destroy')->name('login.destroy');
});

