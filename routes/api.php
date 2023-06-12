<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\MentorController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']); 
});


// Auth Route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Update Password User Route
Route::post('user/{user}/password', [UserController::class, 'updatePassword']);

// Route Resources
Route::apiResource('media', MediaController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('mentor', MentorController::class);
Route::apiResource('course', CourseController::class);
Route::apiResource('chapter', ChapterController::class);