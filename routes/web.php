<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonalProfileController;
use App\Http\Controllers\AlumnoProfileController;
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
    session(['token' => $request->input('token')]);
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
        $sedes = DB::table('sede')->where('estatus', true)->get(['id_sede', 'nombre']);
        $roles = DB::table('rol')->get(['id_rol', 'nombre']);
        return view('dashboardAdmin', compact('alumnos', 'profesores', 'personal', 'sedes', 'roles'));
    })->name('dashboard.admin');

    // Búsqueda con filtros (backend)
    Route::get('/admin/buscar/{tipo}', [AdminController::class, 'buscarUsuarios']);
    // Obtener un usuario por ID (para modal editar)
    Route::get('/admin/obtener/{tipo}/{id}', [AdminController::class, 'obtenerUsuario']);

    Route::get('/dashboardAlumno', function () {
        return view('dashboardAlumno');
    })->name('dashboard.alumno');

    // Rutas AJAX del admin (en web.php para tener acceso a la sesión)
    Route::post('/admin/registrar', [AdminController::class, 'registrarUsuario']);
    Route::put('/admin/editar/{tipo}/{id}', [AdminController::class, 'editarUsuario']);
    Route::delete('/admin/eliminar/{tipo}/{id}', [AdminController::class, 'eliminarUsuario']);
    Route::get('/personal/perfil', [PersonalProfileController::class, 'show']);
    Route::put('/personal/perfil', [PersonalProfileController::class, 'update']);
    Route::put('/personal/perfil/password', [PersonalProfileController::class, 'updatePassword']);

    Route::get('/alumno/perfil', [AlumnoProfileController::class, 'show']);
    Route::put('/alumno/perfil', [AlumnoProfileController::class, 'update']);
    Route::put('/alumno/perfil/password', [AlumnoProfileController::class, 'updatePassword']);
    
    Route::get('/api/alumno/grupos', [App\Http\Controllers\AlumnoGruposController::class, 'index']);
    Route::post('/api/alumno/grupos/{id}/{accion}', [App\Http\Controllers\AlumnoGruposController::class, 'accion']);
    
});