<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('logIn');
});

Route::get('/dashboardAdmin', function () {
    return view('dashboardAdmin');
});

Route::get('/dashboardAlumno', function () {
    return view('dashboardAlumno');
});

Route::get('/landing', function () {
    return view('landing');
});