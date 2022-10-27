<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstaladorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {return redirect()->route('instalador.index');});
Route::post('/getColumnsTable', [InstaladorController::class, 'getColumnsTable'])->name('instalador.getColumnsTable');

Route::prefix('instalador')->group(function () {
    Route::get('/', [InstaladorController::class, 'index'])->name('instalador.index');
    Route::post('/create', [InstaladorController::class, 'create'])->name('instalador.create');
});


