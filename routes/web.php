<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.landing');
});

Route::get('/login', function () {
    return view('logIn');
});

Route::get('/dashboardAdmin', function () {
    return view('dashboardAdmin');
});

Route::get('/dashboardAlumno', function () {
    return view('dashboardAlumno');
});


Route::get('/cursos', function () {
    return view('catalogoCursos');
});

Route::get('/curso', function () {
    return view('curso');
});

Route::get('/registro', function () {
    return view('registro');
});