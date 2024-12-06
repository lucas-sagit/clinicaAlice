<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Página de dashboard protegida por autenticação
Route::get('/dashboard', function () {
    return view('dashboard');
})->name("dashboard");

// Rotas para login e logout
Route::controller(LoginController::class)->group(function() {
    Route::get('login', 'showLoginForm')->name('login');  // Define a rota 'login'
    Route::post('login', 'authenticate');
    Route::get('logout', 'destroy')->name('logout');
});

