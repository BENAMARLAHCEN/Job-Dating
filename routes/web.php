<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'index']);
Route::get('/login', [AuthController::class,'loginForm'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class,'index'])->name('register')->middleware('guest');
Route::post('/login', [AuthController::class,'login'])->name('authenticate')->middleware('guest');
Route::post('/register', [AuthController::class,'register'])->name('auth.register')->middleware('guest');
Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');

Route::get('/announcement/{announcement}', [AnnouncementController::class,'show']);


Route::resource('companies', CompanyController::class)->middleware('auth');
Route::resource('announcements', AnnouncementController::class)->middleware('auth');