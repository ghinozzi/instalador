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
Route::get('/', function () {return redirect()->route('index');});
Route::get('/instalador', [InstaladorController::class, 'index'])->name('instalador.index');
Route::post('/getColumnsTable', [InstaladorController::class, 'getColumnsTable'])->name('instalador.getColumnsTable');
