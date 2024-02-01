<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return redirect('persons');
});

Route::prefix('persons')->group(function () {
    Route::get('/', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/{id}', [PersonController::class, 'getOne'])->name('persons.one');
    Route::post('/', [PersonController::class, 'update'])->name('persons.update');
    Route::post('/import', [PersonController::class, 'import'])->name('persons.import');
    Route::delete('/{id}', [PersonController::class, 'destroy'])->name('persons.delete');
});

Route::prefix('logs')->group(function () {
    Route::get('/', [LogController::class, 'index'])->name('logs.index');
    Route::get('/{id}', [LogController::class, 'getOne'])->name('logs.one');
});
