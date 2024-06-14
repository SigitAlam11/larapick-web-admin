<?php

use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\PickupLogController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/update-password', [UserController::class, 'updatePassword']);

    Route::post('/pickup', [PickupLogController::class, 'pickup']);
    Route::post('/update-pickup-status', [PickupLogController::class, 'updatePickupStatus']);
    Route::get('/pickup-logs-by-student', [PickupLogController::class, 'getPickupLogsByStudent']);

    Route::get('/grades', [GradeController::class, 'index']);

    Route::get('/students-by-grade', [StudentController::class, 'getStudentsByGrade']);
});
