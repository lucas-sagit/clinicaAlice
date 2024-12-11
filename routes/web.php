<?php

use App\Http\Controllers\funcionarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\clienteController;

Route::get('/', function () {
    return view('welcome');
});

// Página de dashboard protegida por autenticação
Route::get('/dashboard', function () {
    return view('dashboard');
})->name("dashboard");

// Rotas para login e logout
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');  // Define a rota 'login'
    Route::post('login', 'authenticate');
    Route::get('logout', 'destroy')->name('logout');
});


Route::controller(ClienteController::class)->group(function () {
    Route::get('cliente', [ClienteController::class, 'showClienteForm'])->name('cliente');
    Route::post('cliente', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('cliente/{id}/edit', [ClienteController::class, 'edit']);
    Route::put('cliente/{id}', [ClienteController::class, 'update']);
    Route::delete('cliente/{id}', [ClienteController::class, 'destroy']);
});




Route::get('/funcionario', function () {
    return view('components.funcionario');  // Isso retornará o componente
});

Route::get('/modal.funcionario', [funcionarioController::class, 'modalFuncionario'])->name('modal.funcionario');


Route::get('/sessao', function () {
    return view('components.sessao');  // Isso retornará o componente
});
