<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Ensure you import the controller

// Registration and Login routes
Route::post('/register', [AuthenticatedSessionController::class, 'store']); // Registration
Route::post('/login', [AuthenticatedSessionController::class, 'store']); // Login
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth:sanctum'); // Updated Logout Route

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Group for admin-specific routes, protected by auth and 'can:admin' gate
Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
    Route::apiResource('admin', AdminController::class);
});

// Group for conductor-specific routes, protected by auth and 'can:conductor' gate
Route::middleware(['auth:sanctum', 'can:conductor'])->group(function () {
    Route::apiResource('conductor', ConductorController::class);
});
