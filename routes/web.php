<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\PickupLogController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('/grades', GradeController::class);
Route::resource('/students', StudentController::class);
Route::resource('/guardians', GuardianController::class);
Route::get('/pickup-logs', [PickupLogController::class, 'index'])->name('pickup-logs.index');
Route::resource('/users', UserController::class);
Route::get('/guardians/{guardian}/reset-password', [GuardianController::class, 'resetPassword'])->name('guardians.reset-password');
