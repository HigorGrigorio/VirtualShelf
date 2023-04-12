<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LanguageController;
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
Route::get('/tables', [CountryController::class, 'index'])->name('tables');

Route::prefix('/tables')->group(function () {

    /**
     * Country
     */
    Route::get('/countries', [CountryController::class, 'index'])->name('tables.country.index');

    Route::prefix('country')->group(function () {
        Route::get('/store', [CountryController::class, 'create'])->name('tables.country.create');
        Route::post('/', [CountryController::class, 'store'])->name('tables.country.store');

        Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('tables.country.edit');
        Route::post('/update/{id}', [CountryController::class, 'update'])->name('tables.country.update');

        Route::get('/delete/{id}', [CountryController::class, 'destroy'])->name('tables.country.destroy');
    });

    /**
     * Author
     */
    Route::get('/authors', [AuthorController::class, 'index'])->name('tables.author.index');

    Route::prefix('author')->group(function () {
        Route::get('/store', [AuthorController::class, 'create'])->name('tables.author.create');
        Route::post('/', [AuthorController::class, 'store'])->name('tables.author.store');

        Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('tables.author.edit');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('tables.author.update');

        Route::get('/delete/{id}', [AuthorController::class, 'destroy'])->name('tables.author.destroy');
    });

    Route::get('/languages', [LanguageController::class, 'index'])->name('tables.language.index');

    Route::prefix('language')->group(function () {
        Route::get('/store', [LanguageController::class, 'create'])->name('tables.language.create');
        Route::post('/', [LanguageController::class, 'store'])->name('tables.language.store');

        Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('tables.language.edit');
        Route::post('/update/{id}', [LanguageController::class, 'update'])->name('tables.language.update');

        Route::get('/delete/{id}', [LanguageController::class, 'destroy'])->name('tables.language.destroy');
    });
});
