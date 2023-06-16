<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherStudentAuth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teacher\QuizController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Admin\SchoolYearController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\AuthController as TeacherAuthController;

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
    return view('welcome');
})->name('homepage');



// Route::middleware('guest')->controller(AuthController::class)->group(function() {
//     Route::get('/admin/login', 'index')->name('login');
//     Route::post('/login-process', 'loginHandler')->name('adminLogin.process');
// });

/**
 * Authenticated Admin Route
 */
Route::prefix('admin')->middleware('role:admin')->group(function () {

    Route::get('/', [HomePageController::class, 'index'])->name('admin.index');

    // Route::post('/logout', [AuthController::class, 'logoutHandler'])->name('admin.logout');

    /**
     * Subject Route
     */
    Route::controller(SubjectController::class)->prefix('subject')->name('subject.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('delete');
    });

    /**
     * Class Route
     */
    Route::controller(StudentClassController::class)->prefix('class')->name('class.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'destroy')->name('delete');
        Route::delete('/delete', 'destroyMultiple')->name('deleteSelectedClass');
    });

    /**
     * User Route
     */
    Route::controller(UserController::class)->name('user.')->group(function () {
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
    Route::controller(SchoolYearController::class)->name('sy.')->group(function () {
        Route::get('/sy', 'index')->name('index');
        Route::get('/sy/create', 'create')->name('create');
        Route::post('/sy/store', 'store')->name('store');
        Route::get('/sy/{id}/edit', 'edit')->name('edit');
        Route::put('/sy/{id}/update', 'update')->name('update');
        Route::delete('/sy/{id}/delete', 'destroy')->name('delete');
    });
});


Route::middleware('guest')->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');


    Route::view('/teacher/register', 'teacher.register')->name('teacher.register');
    Route::get('/student/register', [StudentController::class, 'showRegForm'])->name('student.register');
});

/**
 * Teacher Registration Route
 */
Route::post('/teacher/store', [TeacherController::class, 'storeTeacher'])->name('teacher.storeTeacher');
Route::post('/student/store', [StudentController::class, 'storeStudent'])->name('student.store-student');


/**
 * Admin, Teacher and Student Login/Logout Route
 */
Route::post('/login-process', [AuthController::class, 'loginHandler'])->name('teacher-student-auth');
Route::post('/logout-process', [AuthController::class, 'logoutHandler'])->name('logout');


/**
 * Authenticated Teacher Route
 */
Route::prefix('teacher')->middleware('role:teacher')->group(function () {
    Route::controller(TeacherController::class)->name('teacher.')->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/store-class', 'storeClass')->name('storeClass');
        Route::get('/my-students/{unique_id}', 'showMyStudents')->name('my-students');
    });

    Route::controller(QuizController::class)->name('quiz.')->group(function() {
        Route::get('/quiz-list', 'index')->name('quiz-list');
        Route::post('/storeQuiz', 'storeQuiz')->name('storeQuiz');
        Route::get('/quiz-questions/{id}', 'quizQuestionList')->name('quiz-question'); // show the quiz question list
        // Route::get('/create-questions/{id}', 'createQuestion')->name('create-question');
        // Route::post('/storeQuizQuestion', 'storeQuizQuestion')->name('storeQuizQuestion');
        // Route::get('/', 'index')->name('index');
        Route::post('/create-true-or-false-question/{id}', 'makeDynamicTrueOrFalseField')->name('store-true-or-false-quiz-number'); // make a dynamic field by submitting the desire number of questions
        Route::post('/store-true-or-false-quiz-questions', 'storeTrueOrFalseQuizQuestions')->name('store-true-or-false-quiz-questions'); //store the true or false question in database

        Route::post('/create-multiple-choice-question/{id}', 'makeDynamicMultipleChoiceField')->name('store-multiple-choice-quiz-number');
        Route::post('/store-multiple-choice-question', 'storeMultipleChoiceQuestions')->name('store-multiple-choice-questions');

        Route::post('/create-fill-in-the-blank-question/{id}', 'makeDynamicFillInTheBlankField')->name('store-fill-in-the-blank-quiz-number');
        Route::post('/store-fill-in-the-blank-question', 'storeFillInTheBlankQuestions')->name('store-fill-in-the-blank-questions');
    });
});


/**
 * Authenticated Student Route
 */
Route::prefix('student')->middleware('role:student')->group(function() {
    Route::controller(StudentController::class)->name('student.')->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/class-enroll', 'showEnroll')->name('enroll');
        Route::get('/my-classmate/{id}', 'showMyClassmate')->name('my-classmate');
        Route::post('/enroll-to-this-class/{class}','enrollToThisClass')->name('enroll-to-class');
    });
});

