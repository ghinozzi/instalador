
Route::prefix('__tablename__')->group(function () {
    Route::get('/', [__tablename__Controller::class, 'index'])->name('__tablename__.index');
    Route::get('/edit', [__tablename__Controller::class, 'edit'])->name('__tablename__.edit');
    Route::get('/add', [__tablename__Controller::class, 'add'])->name('__tablename__.add');
});