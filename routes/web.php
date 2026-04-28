<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonalProfileController;
use App\Http\Middleware\VerificarToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Profesor;
use App\Models\Personal;

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
    session([
        'token'         => $request->input('token'),
        'tipo'          => $request->input('tipo'),
        'id_sede'       => $request->input('id_sede'),
        'administrativo'=> $request->input('administrativo'),
        'permisos'      => $request->input('permisos'),
    ]);
    return response()->json(['ok' => true]);
})->name('guardar.token');

Route::middleware(VerificarToken::class)->group(function () {
    Route::get('/dashboardAdmin', function () {
        $alumnos = Alumno::leftJoin('sede', 'alumno.id_sede', '=', 'sede.id_sede')
            ->select('alumno.*', 'sede.nombre as nombre_sede')
            ->orderBy('alumno.id_alumno', 'asc')
            ->get();
        $profesores = Profesor::leftJoin('sede', 'profesor.id_sede', '=', 'sede.id_sede')
            ->select('profesor.*', 'sede.nombre as nombre_sede')
            ->orderBy('profesor.id_profesor', 'asc')
            ->get();
        $personal = Personal::leftJoin('rol', 'personal.id_rol', '=', 'rol.id_rol')
            ->select('personal.*', 'rol.nombre as nombre_rol')
            ->orderBy('personal.id_personal', 'asc')
            ->get();
       $sedes = DB::table('sede')->orderBy('id_sede')->get(['id_sede', 'nombre']);
        $roles = DB::table('rol')->get(['id_rol', 'nombre']);
        $token = session('token');
$permisosData = session('permisos');
$permisos = $permisosData ? (object) array_map(fn($v) => filter_var($v, FILTER_VALIDATE_BOOLEAN), $permisosData) : (object)[];
$administrativo = filter_var(session('administrativo', false), FILTER_VALIDATE_BOOLEAN);
return view('dashboardAdmin', compact('alumnos', 'profesores', 'personal', 'sedes', 'roles', 'permisos', 'administrativo'));
    })->name('dashboard.admin');

    Route::get('/dashboardAlumno', function () {
        return view('dashboardAlumno');
    })->name('dashboard.alumno');

    // ── Sedes — ANTES de las rutas genéricas ──────────────────────────
    Route::get('/admin/buscar/sedes',          [AdminController::class, 'buscarSedes']);
    Route::post('/admin/registrar/sede',       [AdminController::class, 'registrarSede']);
    Route::get('/admin/obtener/sede/{id}',     [AdminController::class, 'obtenerSede']);
    Route::put('/admin/editar/sede/{id}',      [AdminController::class, 'editarSede']);
    Route::delete('/admin/eliminar/sede/{id}', [AdminController::class, 'eliminarSede']);

    // ── Rutas genéricas — DESPUÉS de las específicas ──────────────────
    Route::get('/admin/buscar/{tipo}',          [AdminController::class, 'buscarUsuarios']);
    Route::get('/admin/obtener/{tipo}/{id}',    [AdminController::class, 'obtenerUsuario']);
    Route::post('/admin/registrar',             [AdminController::class, 'registrarUsuario']);
    Route::put('/admin/editar/{tipo}/{id}',     [AdminController::class, 'editarUsuario']);
    Route::delete('/admin/eliminar/{tipo}/{id}',[AdminController::class, 'eliminarUsuario']);

    // ── Perfil personal ───────────────────────────────────────────────
    Route::get('/personal/perfil',          [PersonalProfileController::class, 'show']);
    Route::put('/personal/perfil',          [PersonalProfileController::class, 'update']);
    Route::put('/personal/perfil/password', [PersonalProfileController::class, 'updatePassword']);
});