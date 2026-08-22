<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', fn() => view('dashboard'))->name('dashboard');

    Route::controller(LivroController::class)->prefix('/livros')->name('livros.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/criar', 'criar')->name('criar');
        Route::post('/criar', 'criarSubmit')->name('criarSubmit');
        Route::get('/{id}/editar', 'editar')->name('editar');
        Route::post('/{id}/editar', 'editarSubmit')->name('editarSubmit');
        Route::get('/{id}/deletar', 'deletar')->name('deletar');
        Route::post('/{id}/deletar', 'deletarSubmit')->name('deletarSubmit');
    });

    Route::controller(EmprestimoController::class)->prefix('/emprestimos')->name('emprestimos.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/criar', 'criar')->name('criar');
        Route::post('/criar', 'criarSubmit')->name('criarSubmit');
        Route::get('/{id}/editar', 'editar')->name('editar');
        Route::post('/{id}/editar', 'editarSubmit')->name('editarSubmit');
        Route::get('/{id}/deletar', 'deletar')->name('deletar');
        Route::post('/{id}/deletar', 'deletarSubmit')->name('deletarSubmit');
    });
});

Route::middleware([CheckIsNotLogged::class])->controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login-submit', 'loginSubmit')->name('login.submit');
    Route::get('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout');
});
