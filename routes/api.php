<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::get('/user/{id}', [App\Http\Controllers\Api\UserController::class, 'show'])->middleware('auth:sanctum');

Route::post('/logout', [App\Http\Controllers\Api\UserController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/update-password', [App\Http\Controllers\Api\UserController::class, 'updatePassword'])->middleware('auth:sanctum');

Route::post('/pickup', [App\Http\Controllers\Api\PickupLogController::class, 'pickup'])->middleware('auth:sanctum');

Route::get('/pickup-logs', [App\Http\Controllers\Api\PickupLogController::class, 'getPickupLogs'])->middleware('auth:sanctum');
