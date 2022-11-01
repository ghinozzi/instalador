<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\Tipo_usuarioController;
use App\Http\Controllers\UsuariosController;

use App\Http\Controllers\InstaladorController;

Route::get('/', function () {return redirect()->route('instalador.index');});
Route::post('/getColumnsTable', [InstaladorController::class, 'getColumnsTable'])->name('instalador.getColumnsTable');

Route::prefix('instalador')->group(function () {
    Route::get('/', [InstaladorController::class, 'index'])->name('instalador.index');
    Route::post('/create', [InstaladorController::class, 'create'])->name('instalador.create');

});

Route::resource('pokemin',UsuariosController::class);
Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/{usuarios}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::get('/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/store', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::put('/update/{usuarios}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::delete('/destroy', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
});


Route::prefix('tipo_usuario')->group(function () {
    Route::get('/', [Tipo_usuarioController::class, 'index'])->name('tipo_usuario.index');
    Route::get('/{tipo_usuario}/edit', [Tipo_usuarioController::class, 'edit'])->name('tipo_usuario.edit');
    Route::get('/create', [Tipo_usuarioController::class, 'create'])->name('tipo_usuario.create');
    Route::post('/store', [Tipo_usuarioController::class, 'store'])->name('tipo_usuario.store');
    Route::put('/update/{tipo_usuario}', [Tipo_usuarioController::class, 'update'])->name('tipo_usuario.update');
    Route::delete('/destroy', [Tipo_usuarioController::class, 'destroy'])->name('tipo_usuario.destroy');
});

Route::prefix('turmas')->group(function () {
    Route::get('/', [TurmasController::class, 'index'])->name('turmas.index');
    Route::get('/{turmas}/edit', [TurmasController::class, 'edit'])->name('turmas.edit');
    Route::get('/create', [TurmasController::class, 'create'])->name('turmas.create');
    Route::post('/store', [TurmasController::class, 'store'])->name('turmas.store');
    Route::put('/update/{turmas}', [TurmasController::class, 'update'])->name('turmas.update');
    Route::delete('/destroy', [TurmasController::class, 'destroy'])->name('turmas.destroy');
});

