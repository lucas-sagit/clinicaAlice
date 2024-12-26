<?php

use App\Http\Controllers\funcionarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\sessaoController;

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

//cliente
Route::controller(ClienteController::class)->group(function () {
    Route::get('cliente', [ClienteController::class, 'showClienteForm'])->name('cliente');
    Route::post('cliente', [ClienteController::class, 'store'])->name('cliente.store');
    Route::put('cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('cliente/{id}', [ClienteController::class, 'destroy']);
});

// funcionario
Route::controller(funcionarioController::class)->group(function (){
    Route::get('funcionario', [funcionarioController::class, 'showFuncionarioForm'])->name('funcionario');
    Route::post('funcionario', [funcionarioController::class, 'store'])->name('funcionario.store');
    Route::put('funcionario/{id}', [funcionarioController::class. 'update'])->name('funcionario.update');
    Route::delete('funcionario/{id}', [funcionarioController::class, 'destroy']);
});


Route::controller(sessaoController::class)->group(function () {
    Route::get('sessao', [sessaoController::class, 'showSessaoForm'])->name('sessao');
    Route::post('sessao', [sessaoController::class, 'store'])->name('sessao.store');


});
