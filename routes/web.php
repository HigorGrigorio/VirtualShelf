<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Language\StoresLanguage;
use App\Http\Controllers\Language\LoadLanguagesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
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

        Route::get('/show/{id}', [CountryController::class, 'show'])->name('tables.country.show');

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

        Route::get('/show/{id}', [AuthorController::class, 'show'])->name('tables.author.show');

        Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('tables.author.edit');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('tables.author.update');

        Route::get('/delete/{id}', [AuthorController::class, 'destroy'])->name('tables.author.destroy');
    });

    /**
     * Language
     */
    Route::get('/languages', [LanguageController::class, 'index'])->name('tables.language.index');

    Route::prefix('language')->group(function () {
        Route::get('/store', [LanguageController::class, 'create'])->name('tables.language.create');
        Route::post('/', [LanguageController::class, 'store'])->name('tables.language.store');

        Route::get('/show/{id}', [LanguageController::class, 'show'])->name('tables.language.show');

        Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('tables.language.edit');
        Route::post('/update/{id}', [LanguageController::class, 'update'])->name('tables.language.update');

        Route::get('/delete/{id}', [LanguageController::class, 'destroy'])->name('tables.language.destroy');
    });

    /**
     * Category
     */
    Route::get('/categories', [CategoryController::class, 'index'])->name('tables.category.index');

    Route::prefix('category')->group(function () {
        Route::get('/store', [CategoryController::class, 'create'])->name('tables.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('tables.category.store');

        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('tables.category.show');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('tables.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('tables.category.update');

        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('tables.category.destroy');
    });
});
