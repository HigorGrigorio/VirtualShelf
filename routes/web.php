<?php

use App\Http\Controllers\Auth\ConfirmPassword\ConfirmPasswordController;
use App\Http\Controllers\Auth\ConfirmPassword\ShowConfirmPasswordController;
use App\Http\Controllers\Auth\ForgottenPassword\ResetPasswordController;
use App\Http\Controllers\Auth\ForgottenPassword\SendResetPasswordLinkEmailController;
use App\Http\Controllers\Auth\ForgottenPassword\ShowForgotPasswordController;
use App\Http\Controllers\Auth\ForgottenPassword\ShowResetPasswordController;
use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Auth\Login\LogoutController;
use App\Http\Controllers\Auth\Login\ShowLoginController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\Auth\Register\ShowRegistrationController;
use App\Http\Controllers\Auth\Verification\ResendVerificationCode;
use App\Http\Controllers\Auth\Verification\ShowVerification;
use App\Http\Controllers\Auth\Verification\VerificationController;
use App\Http\Controllers\Author\DeleteAuthorController;
use App\Http\Controllers\Author\ExportAuthorsController;
use App\Http\Controllers\Author\LoadAuthorsController;
use App\Http\Controllers\Author\ShowAuthorController;
use App\Http\Controllers\Author\ShowEditAuthorFormController;
use App\Http\Controllers\Author\ShowStoreAuthorFormController;
use App\Http\Controllers\Author\StoreAuthorController;
use App\Http\Controllers\Author\UpdateAuthorController;
use App\Http\Controllers\Category\DeleteCategoryController;
use App\Http\Controllers\Category\ExportCategoriesController;
use App\Http\Controllers\Category\LoadCategoriesController;
use App\Http\Controllers\Category\ShowCategoryController;
use App\Http\Controllers\Category\ShowEditCategoryFormController;
use App\Http\Controllers\Category\ShowStoreCategoryFormController;
use App\Http\Controllers\Category\StoreCategoryController;
use App\Http\Controllers\Category\UpdateCategoryController;
use App\Http\Controllers\Country\DeleteCountryController;
use App\Http\Controllers\Country\ExportCountriesController;
use App\Http\Controllers\Country\LoadCountriesController;
use App\Http\Controllers\Country\ShowCountryController;
use App\Http\Controllers\Country\ShowEditCountryFormController;
use App\Http\Controllers\Country\ShowStoreCountryFormController;
use App\Http\Controllers\Country\StoreCountryController;
use App\Http\Controllers\Country\UpdateCountryController;
use App\Http\Controllers\Language\DeleteLanguageController;
use App\Http\Controllers\Language\ExportLanguagesController;
use App\Http\Controllers\Language\LoadLanguagesController;
use App\Http\Controllers\Language\ShowEditLanguageFormController;
use App\Http\Controllers\Language\ShowLanguageController;
use App\Http\Controllers\Language\ShowStoreLanguageFormController;
use App\Http\Controllers\Language\StoreLanguageController;
use App\Http\Controllers\Language\UpdateLanguageController;
use App\Http\Controllers\State\LoadStatesController;
use App\Http\Controllers\State\ShowStateController;
use App\Http\Controllers\State\ShowStoreStateFormController;
use App\Http\Controllers\State\StoreStateController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\ExportUsersController;
use App\Http\Controllers\User\LoadUsersController;
use App\Http\Controllers\User\ShowEditUserFormController;
use App\Http\Controllers\User\ShowStoreUserFormController;
use App\Http\Controllers\User\ShowUserController;
use App\Http\Controllers\User\StoreUserController;
use App\Http\Controllers\User\UpdateUserController;
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

Route::get('/login', [ShowLoginController::class, 'handle'])->name('login.show');
Route::post('/login', [LoginController::class, 'handle'])->name('login');
Route::post('/logout', [LogoutController::class, 'handle'])->name('logout');

Route::post('/password/email', [SendResetPasswordLinkEmailController::class, 'handle'])->name('password.email');

Route::get('/password/reset', [ShowForgotPasswordController::class, 'handle'])->name('password.reset');
Route::get('/password/reset/{token}', [ShowResetPasswordController::class, 'handle'])->name('password.reset.token');
Route::post('/password/reset', [ResetPasswordController::class, 'handle'])->name('password.update');

Route::get('/register', [ShowRegistrationController::class, 'handle'])->name('register.show');
Route::post('/register', [RegisterController::class, 'handle'])->name('register');

Route::get('/email/verify', [ShowVerification::class, 'handle'])->name('verification.notice');
Route::post('/email/resend', [ResendVerificationCode::class, 'handle'])->name('verification.resend');
Route::get('/verify/{id}/{hash}', [VerificationController::class, 'handle'])->name('verification.verify');

Route::get('/password/confirm', [ShowConfirmPasswordController::class, 'handle'])->name('password.confirm');
Route::post('/password/confirm', [ConfirmPasswordController::class, 'handle']);

/*
 * Tables routes
 */

Route::prefix('/tables')->middleware('auth')->group(function () {
    Route::get('/tables', [])->name('tables');

    /**
     * Country
     */
    Route::prefix('country')->group(function () {
        Route::get('/', [LoadCountriesController::class, 'handle'])->name('tables.country.index');

        Route::get('/store', [ShowStoreCountryFormController::class, 'handle'])->name('tables.country.create');
        Route::post('/', [StoreCountryController::class, 'handle'])->name('tables.country.store');

        Route::get('/show/{id}', [ShowCountryController::class, 'handle'])->name('tables.country.show');

        Route::get('/edit/{id}', [ShowEditCountryFormController::class, 'handle'])->name('tables.country.edit');
        Route::post('/update/{id}', [UpdateCountryController::class, 'handle'])->name('tables.country.update');

        Route::get('/delete/{id}', [DeleteCountryController::class, 'handle'])->name('tables.country.destroy');

        Route::post('/export/{format}', [ExportCountriesController::class, 'handle'])->name('tables.country.export');
    });

    /**
     * Author
     */
    Route::prefix('authors')->group(function () {
        Route::get('/', [LoadAuthorsController::class, 'handle'])->name('tables.author.index');

        Route::get('/create', [ShowStoreAuthorFormController::class, 'handle'])->name('tables.author.create');
        Route::post('/', [StoreAuthorController::class, 'handle'])->name('tables.author.store');

        Route::get('/show/{id}', [ShowAuthorController::class, 'handle'])->name('tables.author.show');

        Route::get('/edit/{id}', [ShowEditAuthorFormController::class, 'handle'])->name('tables.author.edit');
        Route::post('/update/{id}', [UpdateAuthorController::class, 'handle'])->name('tables.author.update');

        Route::get('/delete/{id}', [DeleteAuthorController::class, 'handle'])->name('tables.author.destroy');

        Route::post('/export/{format}', [ExportAuthorsController::class, 'handle'])->name('tables.author.export');
    });

    /**
     * Language
     */
    Route::prefix('languages')->group(function () {
        Route::get('/', [LoadLanguagesController::class, 'handle'])->name('tables.language.index');

        Route::get('/store', [ShowStoreLanguageFormController::class, 'handle'])->name('tables.language.create');
        Route::post('/', [StoreLanguageController::class, 'handle'])->name('tables.language.store');

        Route::get('/show/{id}', [ShowLanguageController::class, 'handle'])->name('tables.language.show');

        Route::get('/edit/{id}', [ShowEditLanguageFormController::class, 'handle'])->name('tables.language.edit');
        Route::post('/update/{id}', [UpdateLanguageController::class, 'handle'])->name('tables.language.update');

        Route::get('/delete/{id}', [DeleteLanguageController::class, 'handle'])->name('tables.language.destroy');

        Route::post('/export/{format}', [ExportLanguagesController::class, 'handle'])->name('tables.language.export');
    });

    /**
     * Category
     */
    Route::prefix('category')->group(function () {
        Route::get('/', [LoadCategoriesController::class, 'handle'])->name('tables.category.index');

        Route::get('/store', [ShowStoreCategoryFormController::class, 'handle'])->name('tables.category.create');
        Route::post('/', [StoreCategoryController::class, 'handle'])->name('tables.category.store');

        Route::get('/show/{id}', [ShowCategoryController::class, 'handle'])->name('tables.category.show');

        Route::get('/edit/{id}', [ShowEditCategoryFormController::class, 'handle'])->name('tables.category.edit');
        Route::post('/update/{id}', [UpdateCategoryController::class, 'handle'])->name('tables.category.update');

        Route::get('/delete/{id}', [DeleteCategoryController::class, 'handle'])->name('tables.category.destroy');

        Route::post('/export/{format}', [ExportCategoriesController::class, 'handle'])->name('tables.category.export');
    });

    /**
     * User
     */
    Route::prefix('users')->group(function () {
        Route::get('/', [LoadUsersController::class, 'handle'])->name('tables.user.index');

        Route::get('/store', [ShowStoreUserFormController::class, 'handle'])->name('tables.user.create');
        Route::post('/', [StoreUserController::class, 'handle'])->name('tables.user.store');

        Route::get('/show/{id}', [ShowUserController::class, 'handle'])->name('tables.user.show');

        Route::get('/edit/{id}', [ShowEditUserFormController::class, 'handle'])->name('tables.user.edit');
        Route::post('/update/{id}', [UpdateUserController::class, 'handle'])->name('tables.user.update');

        Route::get('/delete/{id}', [DeleteUserController::class, 'handle'])->name('tables.user.destroy');

        Route::post('/export/{format}', [ExportUsersController::class, 'handle'])->name('tables.user.export');
    });

    /**
     * Language
     */

    Route::prefix('states')->group(function () {

        Route::get('/', [LoadStatesController::class, 'handle'])->name('tables.state.index');

        Route::get('/store', [ShowStoreStateFormController::class, 'handle'])->name('tables.state.create');
        Route::post('/', [StoreStateController::class, 'handle'])->name('tables.state.store');

        Route::get('/show/{id}', [ShowStateController::class, 'handle'])->name('tables.state.show');

        Route::get('/edit/{id}', [])->name('tables.state.edit');
        Route::post('/update/{id}', [])->name('tables.state.update');

        Route::get('/delete/{id}', [])->name('tables.state.destroy');

        Route::post('/export/{format}', [])->name('tables.state.export');
    });
});
