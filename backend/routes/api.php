<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProjectController;

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::put('/projects/{id}', [ProjectController::class, 'update']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

Route::get('/Users', [UserController::class, 'index']);
Route::get('/Users/{id}', [UserController::class, 'show']);
Route::post('/Users', [ UserController::class, 'store']);
Route::put('/Users/{id}', [UserController::class, 'update']);
Route::delete('/Users/{id}', [UserController::class, 'destroy']);
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('/Users/login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
});