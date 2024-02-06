<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SkillController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'index'])->name('register')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('authenticate')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/announcement/{announcement}', [AnnouncementController::class, 'show']);


Route::resource('companies', CompanyController::class)->middleware('auth');
Route::resource('announcements', AnnouncementController::class)->middleware('auth');
Route::resource('skills', SkillController::class)->middleware('auth');
Route::resource('roles', RoleController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');

Route::post('/announcements/{announcement}/record-attendance', [AttendanceController::class, 'recordAttendance'])
    ->middleware('auth')
    ->name('announcements.recordAttendance');

Route::delete('/announcements/{announcement}/unrecord-attendance', [AttendanceController::class, 'unrecordAttendance'])
    ->middleware('auth')
    ->name('announcements.unrecordAttendance');

    Route::get('/attendances', [AttendanceController::class, 'index'])
    ->middleware('auth')
    ->name('attendances.index');
    Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy'])
    ->middleware('auth')
    ->name('attendances.destroy');
    