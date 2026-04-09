<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\VerificarToken;
use Illuminate\Support\Facades\Route;

// ── Página pública ─────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('website.landing');
});

// ── Autenticación ──────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Rutas protegidas (requieren sesión activa) ─────────────────────────────
Route::middleware(VerificarToken::class)->group(function () {

    Route::get('/dashboardAdmin', function () {
        return view('dashboardAdmin');
    })->name('dashboard.admin');

    Route::get('/dashboardAlumno', function () {
        return view('dashboardAlumno');
    })->name('dashboard.alumno');
});