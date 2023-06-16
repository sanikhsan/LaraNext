<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\CourseImageController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\MentorController;
use App\Http\Controllers\API\MyCourseController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Other\TripayCallbackController;
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

// Auth Route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Route Tripay Webhook
Route::post('tripay-webhook', [TripayCallbackController::class, 'handle']);

Route::middleware('auth:sanctum')->group(function () {
    // Update Password User Route
    Route::post('user/{user}/password', [UserController::class, 'updatePassword']);

    // Logout / Destroy Token
    Route::post('logout', [AuthController::class, 'logout']); 

    // Route Resources
    Route::apiResource('media', MediaController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('mentor', MentorController::class);
    Route::apiResource('course', CourseController::class);
    Route::apiResource('course-image', CourseImageController::class)->only(['store','destroy']);
    Route::apiResource('chapter', ChapterController::class)->except('show');
    Route::apiResource('lesson', LessonController::class);
    Route::apiResource('my-course', MyCourseController::class)->only(['index', 'store']);
    Route::apiResource('review', ReviewController::class);
    Route::apiResource('order', OrderController::class)->only(['index', 'store']);
});