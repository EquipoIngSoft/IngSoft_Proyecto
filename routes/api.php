<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Dashboard Alumno
    Route::get('/alumno/inicio', [AlumnoController::class, 'inicio']);
});