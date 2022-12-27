<?php

use Illuminate\Support\Facades\Route;

use Ghinozzi\Instalador\Controllers\InstaladorController;


Route::post('/getColumnsTable', [InstaladorController::class, 'getColumnsTable'])->name('instalador.getColumnsTable');

Route::prefix('instalador')->group(function () {
    Route::get('/', [InstaladorController::class, 'index'])->name('instalador.index');
    Route::post('/create', [InstaladorController::class, 'create'])->name('instalador.create');
    Route::post('/upload', [InstaladorController::class, 'upload'])->name('tinymce.upload');
});
