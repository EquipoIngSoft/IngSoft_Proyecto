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
   Portal Administrativo
   ============================================= */
Route::get('/login', function () {
    return view('logIn');
})->name('login');

Route::get('/dashboardAdmin', function () {
    return view('dashboardAdmin');
})->name('dashboardAdmin');

Route::get('/dashboardAlumno', function () {
    return view('dashboardAlumno');
})->name('dashboardAlumno');