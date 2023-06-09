<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SchoolYearController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginHandler'])->name('adminLogin.process');

Route::prefix('admin')->middleware('auth')->group(function() {
    
    Route::get('/logout', [AuthController::class, 'logoutHandler'])->name('admin.logout');

    /**
     * Subject Route
     */
    Route::controller(SubjectController::class)->name('subject.')->group(function() {
        Route::get('/subject', 'index')->name('index');
        Route::get('/subject/create', 'create')->name('create');
        Route::post('subject/store', 'store')->name('store');
        Route::get('/subject/{id}/edit', 'edit')->name('edit');
        Route::put('/subject/{id}/update', 'update')->name('update');
        Route::delete('/subject/{id}/delete', 'destroy')->name('delete');
    });

    /**
     * Class Route
     */
    Route::controller(StudentClassController::class)->name('class.')->group(function() {
        Route::get('/class', 'index')->name('index');
        Route::get('/class/create', 'create')->name('create');
        Route::post('/class/store', 'store')->name('store');
        Route::get('/class/{id}/edit', 'edit')->name('edit');
        Route::put('/class/{id}/update', 'update')->name('update');
        Route::delete('/class/{id}/delete', 'destroy')->name('delete');
    });

    /**
     * User Route
     */
    Route::controller(UserController::class)->name('user.')->group(function() {
        Route::get('/user', 'index')->name('index');
        Route::get('/user/create', 'create')->name('create');
        Route::post('/user/store', 'store')->name('store');
        Route::get('/user/{id}/edit', 'edit')->name('edit');
        Route::put('/user/{id}/update', 'update')->name('update');
        Route::delete('/user/{id}/delete', 'destroy')->name('delete');
    });

    /**
     * School Year Route
     */
    Route::controller(SchooYearController::class)->name('sy.')->group(function() {
        Route::get('/sy', 'index')->name('index');
        Route::get('/sy/create', 'create')->name('create');
        Route::post('/sy/store', 'store')->name('store');
        Route::get('/sy/{id}/edit', 'edit')->name('edit');
        Route::put('/sy/{id}/update', 'update')->name('update');
        Route::delete('/sy/{id}/delete', 'destroy')->name('delete');
    });

});
