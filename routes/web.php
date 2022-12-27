<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Tipo_usuarioController;
use App\Http\Controllers\JoaoController;

Route::get('/', function () {
    return redirect()->route('instalador.index');
});
Route::prefix('joao')->group(function () {
    Route::get('/', [JoaoController::class, 'index'])->name('joao.index');
    Route::get('/{joao}/edit', [JoaoController::class, 'edit'])->name('joao.edit');
    Route::get('/create', [JoaoController::class, 'create'])->name('joao.create');
    Route::post('/store', [JoaoController::class, 'store'])->name('joao.store');
    Route::put('/update/{joao}', [JoaoController::class, 'update'])->name('joao.update');
    Route::delete('/destroy', [JoaoController::class, 'destroy'])->name('joao.destroy');
});

Route::prefix('tipo_usuario')->group(function () {
    Route::get('/', [Tipo_usuarioController::class, 'index'])->name('tipo_usuario.index');
    Route::get('/{tipo_usuario}/edit', [Tipo_usuarioController::class, 'edit'])->name('tipo_usuario.edit');
    Route::get('/create', [Tipo_usuarioController::class, 'create'])->name('tipo_usuario.create');
    Route::post('/store', [Tipo_usuarioController::class, 'store'])->name('tipo_usuario.store');
    Route::put('/update/{tipo_usuario}', [Tipo_usuarioController::class, 'update'])->name('tipo_usuario.update');
    Route::delete('/destroy', [Tipo_usuarioController::class, 'destroy'])->name('tipo_usuario.destroy');
});

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/{usuarios}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::get('/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/store', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::put('/update/{usuarios}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::delete('/destroy', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
});

