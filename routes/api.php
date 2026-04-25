<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Middleware\VerificarToken;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Dashboard Alumno
    Route::get('/alumno/inicio', [AlumnoController::class, 'inicio']);
});

Route::middleware(VerificarToken::class)->group(function () {
    Route::post('/admin/registrar', [AdminController::class, 'registrarUsuario']);
    Route::put('/admin/editar/{tipo}/{id}', [AdminController::class, 'editarUsuario']);
    Route::delete('/admin/eliminar/{tipo}/{id}', [AdminController::class, 'eliminarUsuario']);
});