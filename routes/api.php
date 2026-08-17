<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PhotoController;
use Illuminate\Support\Facades\Route;

// --- مسارات عامة (لا تحتاج تسجيل دخول) ---
Route::post('/login', [AuthController::class, 'login']);
Route::get('/photos', [PhotoController::class, 'index']); // لجلب الصور في الريأكت

// --- مسارات محمية (تحتاج Token في الـ Header) ---
Route::middleware('auth:sanctum')->group(function () {

    // تسجيل الخروج
    Route::post('/logout', [AuthController::class, 'logout']);

    // إدارة الصور (رفع وحذف)
    Route::post('/photos/upload', [PhotoController::class, 'store']);
    Route::post('/photos/{id}', [PhotoController::class, 'destroy']);
Route::get('/photos/archive', [PhotoController::class, 'archive']);
});
