<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dachboard\DashboardController;
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




// For companies
Route::get('companies', [CompanyController::class, 'index'])->middleware(['auth', 'can:view companies'])->name('companies.index');
Route::post('companies', [CompanyController::class, 'store'])->middleware(['auth', 'can:create companies'])->name('companies.store');
Route::get('companies/create', [CompanyController::class, 'create'])->middleware(['auth', 'can:create companies'])->name('companies.create');
Route::get('companies/{company}', [CompanyController::class, 'show'])->middleware(['auth', 'can:view companies'])->name('companies.show');
Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->middleware(['auth', 'can:edit companies'])->name('companies.edit');
Route::put('companies/{company}', [CompanyController::class, 'update'])->middleware(['auth', 'can:edit companies'])->name('companies.update');
Route::delete('companies/{company}', [CompanyController::class, 'destroy'])->middleware(['auth', 'can:delete companies'])->name('companies.destroy');

// For announcements
Route::get('announcements', [AnnouncementController::class, 'index'])->middleware(['auth', 'can:view announcements'])->name('announcements.index');
Route::post('announcements', [AnnouncementController::class, 'store'])->middleware(['auth', 'can:create announcements'])->name('announcements.store');
Route::get('announcements/create', [AnnouncementController::class, 'create'])->middleware(['auth', 'can:create announcements'])->name('announcements.create');
Route::get('announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->middleware(['auth', 'can:edit announcements'])->name('announcements.edit');
Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])->middleware(['auth', 'can:edit announcements'])->name('announcements.update');
Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])->middleware(['auth', 'can:delete announcements'])->name('announcements.destroy');
Route::get('/announcement/{announcement}', [AnnouncementController::class, 'show']);

// For users
Route::get('users', [UserController::class, 'index'])->middleware(['auth', 'can:view users'])->name('users.index');
Route::post('users', [UserController::class, 'store'])->middleware(['auth', 'can:create users'])->name('users.store');
Route::get('users/create', [UserController::class, 'create'])->middleware(['auth', 'can:create users'])->name('users.create');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'can:edit users'])->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->middleware(['auth', 'can:edit users'])->name('users.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'can:delete users'])->name('users.destroy');

// For skills
Route::get('skills', [SkillController::class, 'index'])->middleware(['auth', 'can:view skills'])->name('skills.index');
Route::post('skills', [SkillController::class, 'store'])->middleware(['auth', 'can:create skills'])->name('skills.store');
Route::delete('skills/{skill}', [SkillController::class, 'destroy'])->middleware(['auth', 'can:delete skills'])->name('skills.destroy');
Route::get('skills/create', [SkillController::class, 'create'])->middleware(['auth', 'can:create skills'])->name('skills.create');
Route::get('skills/{skill}/edit', [SkillController::class, 'edit'])->middleware(['auth', 'can:edit skills'])->name('skills.edit');
Route::put('skills/{skill}', [SkillController::class, 'update'])->middleware(['auth', 'can:edit skills'])->name('skills.update');


// For roles
Route::get('roles', [RoleController::class, 'index'])->middleware(['auth', 'can:view roles'])->name('roles.index');
Route::post('roles', [RoleController::class, 'store'])->middleware(['auth', 'can:create roles'])->name('roles.store');
Route::put('roles/{role}', [RoleController::class, 'update'])->middleware(['auth', 'can:edit roles'])->name('roles.update');
Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware(['auth', 'can:delete roles'])->name('roles.destroy');



Route::post('/announcements/{announcement}/record-attendance', [AttendanceController::class, 'recordAttendance'])
    ->middleware(['auth', 'can:record attendance'])
    ->name('announcements.recordAttendance');

Route::delete('/announcements/{announcement}/unrecord-attendance', [AttendanceController::class, 'unrecordAttendance'])
    ->middleware(['auth', 'can:unrecord attendance'])
    ->name('announcements.unrecordAttendance');

Route::get('/attendances', [AttendanceController::class, 'index'])
    ->middleware(['auth', 'can:view attendances'])
    ->name('attendances.index');

Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy'])
    ->middleware(['auth', 'can:delete attendance'])
    ->name('attendances.destroy');

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware(['auth', 'can:view profile'])
    ->name('profile.index');


Route::get('/profile/{user}/show', [ProfileController::class, 'show'])
    ->name('profile.show');


Route::put('/profile/update', [ProfileController::class, 'update'])
    ->middleware(['auth', 'can:edit profile'])
    ->name('profile.update');

Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'can:edit profile'])
    ->name('profile.edit');

Route::put('/profile/update-password', [UserController::class, 'updatePassword'])
    ->middleware(['auth', 'can:update password'])
    ->name('profile.updatePassword');

Route::delete('/user/skills/{skill}', [UserSkillsController::class, 'deleteSkill'])
    ->middleware(['auth', 'can:delete user skills'])
    ->name('user.skills.delete');

Route::post('/user/skills/add', [UserSkillsController::class, 'storeSkills'])
    ->middleware(['auth', 'can:add user skills'])
    ->name('user.skills.store');

    Route::get('statistic',[DashboardController::class,'index'])->middleware(['auth','can:access dashboard'])->name('statistic');