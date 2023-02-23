<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('login', function () {
    return response()->json(["loginUrl" => env("LOGIN_URL")]);
})->name("login");

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
Route::apiResource('tasks', TaskController::class);
