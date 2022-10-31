<?php
/*Atenção: apagar comentarios pode impedir o funcionamento do instalador*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\turmasController;
use App\Http\Controllers\tipo_usuarioController;
use App\Http\Controllers\InstaladorController;

Route::get('/', function () {return redirect()->route('instalador.index');});
Route::post('/getColumnsTable', [InstaladorController::class, 'getColumnsTable'])->name('instalador.getColumnsTable');

Route::prefix('instalador')->group(function () {
    Route::get('/', [InstaladorController::class, 'index'])->name('instalador.index');
    Route::post('/create', [InstaladorController::class, 'create'])->name('instalador.create');

});

Route::prefix('tipo_usuario')->group(function () {
    Route::get('/', [tipo_usuarioController::class, 'index'])->name('tipo_usuario.index');
    Route::get('/edit', [tipo_usuarioController::class, 'edit'])->name('tipo_usuario.edit');
    Route::get('/create', [tipo_usuarioController::class, 'create'])->name('tipo_usuario.create');
});
Route::prefix('turmas')->group(function () {
    Route::get('/', [turmasController::class, 'index'])->name('turmas.index');
    Route::get('/edit', [turmasController::class, 'edit'])->name('turmas.edit');
    Route::get('/create', [turmasController::class, 'create'])->name('turmas.create');
});
Route::prefix('usuarios')->group(function () {
    Route::get('/', [usuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/edit', [usuariosController::class, 'edit'])->name('usuarios.edit');
    Route::get('/create', [usuariosController::class, 'create'])->name('usuarios.create');
});
