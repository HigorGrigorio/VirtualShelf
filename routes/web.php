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

/**
 * Tables routes
 */
Route::prefix('/table')->group(function () {

    /**
     * Country
     */
    Route::get('/countries', [CountryController::class, 'index'])->name('pages.country.index');

    Route::prefix('country')->group(function () {
        Route::get('/store', [CountryController::class, 'create'])->name('table.country.create');
        Route::post('/', [CountryController::class, 'store'])->name('pages.country.store');

        Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('pages.country.edit');
        Route::post('/update/{id}', [CountryController::class, 'update'])->name('pages.country.update');

        Route::get('/delete/{id}', [CountryController::class, 'destroy'])->name('pages.country.destroy');
    });

    /**
     * Author
     */

    Route::get('/authors', [AuthorController::class, 'index'])->name('pages.author.index');

    Route::prefix('author')->group(function () {
        Route::get('/store', [AuthorController::class, 'create'])->name('pages.author.create');
        Route::post('/', [AuthorController::class, 'store'])->name('pages.author.store');

        Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('pages.author.edit');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('pages.author.update');

        Route::get('/delete/{id}', [AuthorController::class, 'destroy'])->name('pages.author.destroy');
    });
});
