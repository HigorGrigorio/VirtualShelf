<?php

use App\Domain\UseCases\Author\DeleteAuthorById;
use App\Http\Controllers\Auth\ForgottenPassword\SendResetPasswordLinkEmailController;
use App\Http\Controllers\Auth\ForgottenPassword\ShowForgotPasswordFormController;
use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Auth\Login\LogoutController;
use App\Http\Controllers\Auth\Login\ShowLoginFormController;
use App\Http\Controllers\Author\DeleteAuthorController;
use App\Http\Controllers\Author\LoadAuthorsController;
use App\Http\Controllers\Author\ShowAuthorController;
use App\Http\Controllers\Author\ShowEditAuthorFormController;
use App\Http\Controllers\Author\ShowStoreAuthorFormController;
use App\Http\Controllers\Author\StoreAuthorController;
use App\Http\Controllers\Author\UpdateAuthorController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Category\LoadCategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\LoadUsersController;
use App\Http\Controllers\User\ShowEditUserFormController;
use App\Http\Controllers\User\ShowStoreUserFormController;
use App\Http\Controllers\User\ShowUserController;
use App\Http\Controllers\User\StoreUserController;
use App\Http\Controllers\User\UpdateUserController;
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

Route::get('/login', [ShowLoginFormController::class, 'handle'])->name('login.show');
Route::post('/login', [LoginController::class, 'handle'])->name('login');
Route::post('/logout', [LogoutController::class, 'handle'])->name('logout');

Route::get('/password/reset', [ShowForgotPasswordFormController::class, 'handle'])->name('password.reset');
Route::post('/password/reset', [SendResetPasswordLinkEmailController::class, 'handle'])->name('password.email');
/**
 * Tables routes
 */
Route::get('/tables', [CountryController::class, 'index'])->name('tables');

Route::prefix('/tables')->middleware('auth')->group(function () {

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
    Route::get('/authors', [LoadAuthorsController::class, 'handle'])->name('tables.author.index');

    Route::prefix('author')->group(function () {
        Route::get('/create', [ShowStoreAuthorFormController::class, 'handle'])->name('tables.author.create');
        Route::post('/', [StoreAuthorController::class, 'handle'])->name('tables.author.store');

        Route::get('/show/{id}', [ShowAuthorController::class, 'handle'])->name('tables.author.show');

        Route::get('/edit/{id}', [ShowEditAuthorFormController::class, 'handle'])->name('tables.author.edit');
        Route::post('/update/{id}', [UpdateAuthorController::class, 'handle'])->name('tables.author.update');

        Route::get('/delete/{id}', [DeleteAuthorController::class, 'handle'])->name('tables.author.destroy');
    });

    /**
     * Language
     */
    Route::get('/languages', [LoadCategoriesController::class, 'handle'])->name('tables.language.index');

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

    /**
     * User
     */
    Route::get('/users', [LoadUsersController::class, 'handle'])->name('tables.user.index');

    Route::prefix('user')->group(function () {
        Route::get('/store', [ShowStoreUserFormController::class, 'handle'])->name('tables.user.create');
        Route::post('/', [StoreUserController::class, 'handle'])->name('tables.user.store');

        Route::get('/show/{id}', [ShowUserController::class, 'handle'])->name('tables.user.show');

        Route::get('/edit/{id}', [ShowEditUserFormController::class, 'handle'])->name('tables.user.edit');
        Route::post('/update/{id}', [UpdateUserController::class, 'handle'])->name('tables.user.update');

        Route::get('/delete/{id}', [DeleteUserController::class, 'handle'])->name('tables.user.destroy');
    });
});
