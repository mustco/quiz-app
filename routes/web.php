<?php

use App\Http\Controllers\Admin\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/kuis/{quiz_id}', [HomeController::class, 'detail'])->name('kuis.detail');
Route::get('/kuis/{quiz_id}/{question_id}', [HomeController::class, 'question'])->name('kuis.pertanyaan')->middleware('quiz.success');
Route::post('/kuis/{quiz_id}/{question_id}', [HomeController::class, 'question_store'])->name('kuis.pertanyaan.store')->middleware('quiz.success');
Route::get('/{quiz_id}/success', [HomeController::class, 'success'])->name('kuis.berhasil');
Route::get('/sukses/{quiz_id}', [HomeController::class, 'berhasil'])->name('success');

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('kuis', QuizController::class);
    Route::resource('pertanyaan', QuestionController::class);
    Route::resource('user', UserController::class);
});
Route::post('pertanyaan/import_excel',[QuestionController::class, 'import_excel'])->name('pertanyaan.import');
Route::get('/download-template', [QuestionController::class, 'download'])->name('download');