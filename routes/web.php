<?php

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

/**
 * Subject Route
 */
Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
Route::post('subject/store', [SubjectController::class, 'store'])->name('subject.store');
Route::get('/subject/{id}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
Route::put('/subject/{id}/update', [SubjectController::class, 'update'])->name('subject.update');
Route::delete('/subject/{id}/delete', [SubjectController::class, 'destroy'])->name('subject.delete');

/**
 * Class Route
 */
Route::get('/class', [StudentClassController::class, 'index'])->name('class.index');
Route::get('/class/create', [StudentClassController::class, 'create'])->name('class.create');
Route::post('/class/store', [StudentClassController::class, 'store'])->name('class.store');
Route::get('/class/{id}/edit', [StudentClassController::class, 'edit'])->name('class.edit');
Route::put('/class/{id}/update', [StudentClassController::class, 'update'])->name('class.update');
Route::delete('/class/{id}/delete', [StudentClassController::class, 'destroy'])->name('class.delete');

/**
 * User Route
 */
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');