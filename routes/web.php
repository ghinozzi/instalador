<?php

use Illuminate\Support\Facades\Route;
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

