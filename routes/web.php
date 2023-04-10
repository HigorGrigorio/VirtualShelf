<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

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

Route::prefix('/table')->group(function () {
    Route::get('/countries', [CountryController::class, 'index']);

    Route::prefix('country')->group(function () {
        Route::get('/store', [CountryController::class, 'create']);
        Route::post('/', [CountryController::class, 'store']);

        Route::get('/edit/{id}', [CountryController::class, 'edit']);
        Route::post('/update/{id}', [CountryController::class, 'update']);

        Route::get('/delete/{id}', [CountryController::class, 'destroy']);
    });

    Route::get('/authors', [AuthorController::class, 'index'])->name('table.author.index');
});
