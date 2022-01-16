<?php

use App\Http\Controllers\StudentController;
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
})->name('/');

Route::get('/student-index', [StudentController::class, 'index'])->name('student-index');
Route::post('/student-store', [StudentController::class, 'studentStore'])->name('student-store');
Route::post('/grade-store', [StudentController::class, 'gradeStore'])->name('grade-store');
