Route::prefix('__TableName__')->group(function () {
    Route::get('/', [__ModelName__Controller::class, 'index'])->name('__TableName__.index');
    Route::get('/{__NomeVariavel__}/edit', [__ModelName__Controller::class, 'edit'])->name('__TableName__.edit');
    Route::get('/create', [__ModelName__Controller::class, 'create'])->name('__TableName__.create');
    Route::post('/store', [__ModelName__Controller::class, 'store'])->name('__TableName__.store');
    Route::put('/update/{__NomeVariavel__}', [__ModelName__Controller::class, 'update'])->name('__TableName__.update');
    Route::delete('/destroy', [__ModelName__Controller::class, 'destroy'])->name('__TableName__.destroy');
});

