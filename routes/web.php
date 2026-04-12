<?php

use Illuminate\Support\Facades\Route;

/* =============================================
   Portal Web Público
   ============================================= */
Route::get('/', function () {
    return view('website.landing');
})->name('landing');

Route::get('/cursos', function () {
    return view('website.cursos');
})->name('cursos');

Route::get('/sedes', function () {
    return view('website.sedes');
})->name('sedes');

Route::get('/testimonios', function () {
    return view('website.testimonios');
})->name('testimonios');

Route::get('/blog', function () {
    return view('website.blog');
})->name('blog');

Route::get('/contacto', function () {
    return view('website.contacto');
})->name('contacto');

/* =============================================
   Autenticación
   ============================================= */
Route::get('/login', function () {
    return view('logIn');
})->name('login');

/* =============================================
   Portal Administrativo
   ============================================= */
Route::get('/dashboardAdmin', function () {
    return view('dashboardAdmin');
})->name('dashboardAdmin');

/* =============================================
   Portal del Estudiante (Dashboard Alumno)
   ============================================= */
Route::prefix('alumno')->name('alumno.')->group(function () {

    Route::get('/inicio', function () {
        return view('dashboardAlumno.inicio');
    })->name('inicio');

    Route::get('/miNivel', function () {
        return view('dashboardAlumno.miNivel');
    })->name('miNivel');

    Route::get('/misGrupos', function () {
        return view('dashboardAlumno.misGrupos');
    })->name('misGrupos');

    Route::get('/extraescolares', function () {
        return view('dashboardAlumno.extraescolares');
    })->name('extraescolares');

    Route::get('/profesores', function () {
        return view('dashboardAlumno.profesores');
    })->name('profesores');

    Route::get('/pagos', function () {
        return view('dashboardAlumno.pagos');
    })->name('pagos');

    Route::get('/miPerfil', function () {
        return view('dashboardAlumno.miPerfil');
    })->name('miPerfil');

});

/* Ruta legacy — redirige al nuevo Inicio del alumno */
Route::get('/dashboardAlumno', function () {
    return redirect()->route('alumno.inicio');
})->name('dashboardAlumno');