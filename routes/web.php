<?php
use App\Http\Controllers\AuthController;
use App\Http\Middleware\VerificarToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/guardar-token', function (Request $request) {
    session(['token' => $request->input('token')]);
    return response()->json(['ok' => true]);
})->name('guardar.token');

Route::middleware(VerificarToken::class)->group(function () {
    Route::get('/dashboardAdmin', function () {
        return view('dashboardAdmin');
    })->name('dashboard.admin');

    Route::get('/dashboardAlumno', function () {
        return view('dashboardAlumno');
    })->name('dashboard.alumno');
});