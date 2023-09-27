<?php

use App\Http\Controllers\Api\DeskTagController;
use App\Http\Controllers\Api\DeskTaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserDeskController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getAuthUser']);
Route::middleware('auth:sanctum')->post('/user', [UserController::class, 'updateUser']);
Route::middleware('auth:sanctum')->get('/desk', [UserDeskController::class, 'getUserDesk']);
Route::middleware('auth:sanctum')->get('/tag', [DeskTagController::class, 'showTagsForUserDesk']);
Route::middleware('auth:sanctum')->post('/tag', [DeskTagController::class, 'createTagForUserDesk']);
Route::middleware('auth:sanctum')->delete('/tag/{id}/delete', [DeskTagController::class, 'deleteTagForUserDesk']);
Route::middleware('auth:sanctum')->get('/task', [DeskTaskController::class, 'showTaskForUserDesk']);
Route::middleware('auth:sanctum')->get('/task/{id}', [DeskTaskController::class, 'showOneTaskForUserDesk']);
Route::middleware('auth:sanctum')->post('/task', [DeskTaskController::class, 'createTaskForUserDesk']);
Route::middleware('auth:sanctum')->put('/task/update', [DeskTaskController::class, 'updateTaskForUserDesk']);
Route::middleware('auth:sanctum')->delete('/task/{id}/delete', [DeskTaskController::class, 'deleteTaskForUserDesk']);


Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

