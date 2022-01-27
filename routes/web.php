<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/request/formateur', function () {
    return view('home.formateurRequest');
})->name('formateurRequest');

Auth::routes();

Route::get('/categories/{category}', [App\Http\Controllers\HomeController::class, 'searchCategories'])->name('searchCategories');
Route::post('/course/search', [App\Http\Controllers\HomeController::class, 'searchCourse'])->name('searchCourse');
Route::get('/course/tag/search/{id}', [App\Http\Controllers\HomeController::class, 'searchWithTag'])->name('searchWithTag');
Route::get('/course/author/search/{id}', [App\Http\Controllers\HomeController::class, 'searchWithAuthor'])->name('searchWithAuthor');
Route::get('/course/{slug}', [App\Http\Controllers\HomeController::class, 'course'])->name('course.details');
Route::get('/checkout/buy/{slug}', [App\Http\Controllers\HomeController::class, 'checkoutBuy'])->name('course.buy');
Route::post('/charge/{id}', [App\Http\Controllers\PaymentController::class, 'charge'])->name('course.charge');


// route admin
Route::get('/dashboard/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('adminDashboard')->middleware('admin');
Route::get('/dashboard/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users')->middleware('admin');
Route::post('/dashboard/admin/users/add', [App\Http\Controllers\AdminController::class, 'addUser'])->name('addUser')->middleware('admin');
Route::get('/dashboard/admin/statistics', [App\Http\Controllers\AdminController::class, 'statistics'])->name('statisticsAdmin')->middleware('admin');

Route::get('/dashboard/admin/requests/formateur', [App\Http\Controllers\AdminController::class, 'formateursRequest'])->name('formateursRequestAdmin')->middleware('admin');
Route::put('/dashboard/admin/requests/formateur/validation/{id}', [App\Http\Controllers\AdminController::class, 'validateFormateurRequest'])->name('validateFormateurRequest')->middleware('admin');


// route formateur
Route::get('/dashboard/formateur', [App\Http\Controllers\FormateurController::class, 'index'])->name('formateurdashboard')->middleware('formateur');
Route::get('/dashboard/formateur/formation/create', [App\Http\Controllers\CourseController::class, 'create'])->name('courses.create')->middleware('formateur');
Route::post('/dashboard/formateur/formation/store', [App\Http\Controllers\CourseController::class, 'store'])->name('courses.store')->middleware('formateur');
Route::get('/dashboard/formateur/formation/edit', [App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit')->middleware('formateur');
Route::put('/dashboard/formateur/formation/update/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('courses.update')->middleware('formateur');
Route::get('/dashboard/formateur/episodes/create', [App\Http\Controllers\EpisodeController::class, 'create'])->name('episodes.create')->middleware('formateur');
Route::post('/dashboard/formateur/episodes/store', [App\Http\Controllers\EpisodeController::class, 'store'])->name('episodes.store')->middleware('formateur');
Route::get('/dashboard/formateur/episodes/edit', [App\Http\Controllers\EpisodeController::class, 'edit'])->name('episodes.edit')->middleware('formateur');
Route::put('/dashboard/formateur/episodes/update/{id}', [App\Http\Controllers\EpisodeController::class, 'update'])->name('episodes.update')->middleware('formateur');
Route::delete('/dashboard/formateur/episodes/delete/{id}', [App\Http\Controllers\EpisodeController::class, 'delete'])->name('episodes.delete')->middleware('formateur');
Route::get('/dashboard/formateur/episodes/get/{path}/{id?}', [App\Http\Controllers\EpisodeController::class, 'getVideo'])->name('getVideo')->middleware('formateur');
Route::get('/dashboard/formateur/episodes/pdf/{path}/{id?}', [App\Http\Controllers\EpisodeController::class, 'getPDF'])->name('getPDF')->middleware('formateur');
Route::get('/dashboard/formateur/episodes/search', [App\Http\Controllers\EpisodeController::class, 'getEpisodes'])->name('getEpisodes')->middleware('formateur');
Route::get('/dashboard/formateur/statistics', [App\Http\Controllers\FormateurController::class, 'statistics'])->name('statistics')->middleware('formateur');

// route student
Route::get('/dashboard/student', [App\Http\Controllers\StudentController::class, 'index'])->name('studentDashboard')->middleware('student');
Route::get('/dashboard/student/profil', [App\Http\Controllers\ProfileController::class, 'index'])->name('studentProfil')->middleware('student');
Route::put('/dashboard/student/profil/editPassword', [App\Http\Controllers\ProfileController::class, 'editPassword'])->name('editPassword')->middleware('student');
Route::put('/dashboard/student/profil/editInformations', [App\Http\Controllers\ProfileController::class, 'editInformations'])->name('editInformations')->middleware('student');
Route::get('/dashboard/lectures/enrolled/{id}', [App\Http\Controllers\StudentController::class, 'lectures'])->name('lectures')->middleware('student');
Route::get('/dashboard/student/episodes/video/{id}', [App\Http\Controllers\StudentController::class, 'getVideo'])->middleware('student');
Route::get('/dashboard/student/download/pdf/{id}', [App\Http\Controllers\StudentController::class, 'getPdf'])->name('getPdfs')->middleware('student');
Route::get('/dashboard/student/episodes/finished/{id}', [App\Http\Controllers\StudentController::class, 'episodeFinish'])->name('episodeFinish')->middleware('student');
Route::get('/dashboard/student/certificat/{id}', [App\Http\Controllers\StudentController::class, 'downloadCertificate'])->name('downloadCertificate');
Route::get('/dashboard/student/course/categorie/{category}', [App\Http\Controllers\StudentController::class, 'getStudentCourseByCategory'])->name('getStudentCourseByCategory');
Route::post('/dashboard/student/course/search', [App\Http\Controllers\StudentController::class, 'getStudentCourseSearch'])->name('getStudentCourseSearch');

//validator
Route::get('/dashboard/validate/course', [App\Http\Controllers\ValidateController::class, 'courseValidation'])->name('dashboardValidate')->middleware('validator');
Route::put('/dashboard/admin/courses/validation/{id}', [App\Http\Controllers\ValidateController::class, 'validateCourse'])->name('validateCourse')->middleware('validator');

//formateur request 
Route::post('/formateur/new/request', [App\Http\Controllers\HomeController::class, 'formateurRequest'])->name('formateurRequestAdd');
//edit profil
