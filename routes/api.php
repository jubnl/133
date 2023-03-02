<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tasks API Routes
|--------------------------------------------------------------------------
|
| GET /api/tasks
| HEAD /api/tasks
| GET /api/tasks/:id
| HEAD /api/tasks/:id
| POST /api/tasks
| PUT /api/tasks/:id
| PATCH /api/tasks/:id
| DELETE /api/tasks/:id
*/
Route::apiResource('/tasks', TaskController::class)->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/token/issue', [AuthController::class, 'issueToken'])->middleware('auth:sanctum');
Route::post('/token/revoke', [AuthController::class, 'revokeAllTokens'])->middleware('auth:sanctum');
Route::post('/token/revoke/{tokenId}', [AuthController::class, 'revokeTokenById'])->middleware('auth:sanctum');

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
