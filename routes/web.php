<?php

use App\Http\Controllers\Cadastro;
use App\Http\Controllers\Login;
use App\Http\Controllers\Main;
use Illuminate\Support\Facades\Route;







Route::middleware('CheckLogin')->group(function(){
    Route::get('/home', [Main::class, 'home'])->name('home');
    Route::get('/logout', [Login::class, 'logout'])->name('logout');

    Route::get('nova_tarefa', [Main::class, 'nova_tarefa'])->name('nova_tarefa');
    Route::post('submeter_nova_tarefa', [Main::class, 'submeter_nova_tarefa'])->name('submeter_nova_tarefa');

    Route::get('pesquisar_tarefa', [Main::class, 'pesquisar_tarefa'])->name('pesquisar_tarefa');

    Route::get('/editar_tarefa/{id}', [Main::class], 'editar_tarefa')->name('editar_tarefa');
    Route::post('/editar_tarefa', [Main::class], 'editar_tarefa')->name('editar_tarefa');

    Route::get('/deletar_tarefa/{id}', [Main::class], 'deletar_tarefa')->name('deletar_tarefa');
    Route::get('/deletar_tarefa/{id}', [Main::class], 'deletar_tarefa')->name('deletar_tarefa');
});

Route::middleware('CheckLogout')->group(function(){
    Route::get('/cadastro', [Cadastro::class, 'cadastro'])->name('cadastro');
    Route::post('/criarCadastro', [Cadastro::class, 'criarCadastro'])->name('criarCadastro');

    Route::get('/', [Login::class, 'login'])->name('login');
    Route::post('/submeter_login', [Login::class, 'submeter_login'])->name('submeter_login');
});
