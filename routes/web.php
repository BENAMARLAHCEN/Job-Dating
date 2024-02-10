<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserSkillsController;
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
Route::resource('announcements', AnnouncementController::class)->except('show')->middleware(['role:admin']);
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

Route::get('/profile',[ProfileController::class,'index']);
Route::put('/profile/update',[ProfileController::class,'update'])->name('profile.update');
Route::get('/profile/edit',[ProfileController::class,'edit'])->name('profile.edit');
Route::put('/profile/update-password', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
Route::delete('/user/skills/{skill}', [UserSkillsController::class,'deleteSkill'])->name('user.skills.delete');
Route::post('/user/skills/add', [UserSkillsController::class,'storeSkills'])->name('user.skills.store');

