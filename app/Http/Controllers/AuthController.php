<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumno;
use App\Models\Personal;
use App\Models\Profesor;

class AuthController extends Controller
{
    /**
     * Muestra la vista del login.
     * Si ya hay sesión activa redirige al dashboard correspondiente.
     */
    public function showLogin()
    {
        if (session()->has('usuario_id')) {
            return session('usuario_tipo') === 'personal'
                ? redirect()->route('dashboard.admin')
                : redirect()->route('dashboard.alumno');
        }

        return view('logIn');
    }

    /**
     * Procesa el inicio de sesión.
     *
     * Tab "alumno"   → busca en tabla `alumno`
     * Tab "personal" → busca en tabla `personal` y luego en `profesor`
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|min:6',
            'tipo'     => 'required|in:alumno,personal',
        ], [
            'username.required' => 'El correo es obligatorio.',
            'username.email'    => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $email    = $request->input('username');
        $password = $request->input('password');
        $tipo     = $request->input('tipo');

        // ── Tab ALUMNO ─────────────────────────────────────────────────────
        if ($tipo === 'alumno') {

            $usuario = Alumno::where('email', $email)
                             ->where('estatus', true)
                             ->first();

            if (!$usuario || !Hash::check($password, $usuario->getAuthPassword())) {
                return $this->loginFailed($request);
            }

            session([
                'usuario_id'     => $usuario->id_alumno,
                'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido_p,
                'usuario_tipo'   => 'alumno',
                'usuario_email'  => $usuario->email,
            ]);

            return redirect()->route('dashboard.alumno');
        }

        // ── Tab PERSONAL (personal administrativo + profesores) ────────────
        // 1) Buscar en la tabla `personal`
        $usuario = Personal::where('email', $email)
                           ->where('estatus', true)
                           ->first();

        // 2) Si no está, buscar en la tabla `profesor`
        if (!$usuario) {
            $usuario = Profesor::where('email', $email)
                               ->where('estatus', true)
                               ->first();
        }

        // 3) Verificar que se encontró y que la contraseña coincide
        if (!$usuario || !Hash::check($password, $usuario->getAuthPassword())) {
            return $this->loginFailed($request);
        }

        // Determinar si es personal administrativo o profesor
        $esProfesor = $usuario instanceof Profesor;

        session([
            'usuario_id'     => $esProfesor ? $usuario->id_profesor : $usuario->id_personal,
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido_p,
            'usuario_tipo'   => 'personal',
            'usuario_rol'    => $esProfesor ? 'profesor' : $usuario->id_rol,
            'usuario_email'  => $usuario->email,
        ]);

        return redirect()->route('dashboard.admin');
    }

    /**
     * Cierra la sesión activa.
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    // ── Helpers ───────────────────────────────────────────────────────────

    /**
     * Redirige de vuelta al login con mensaje de error genérico.
     */
    private function loginFailed(Request $request)
    {
        return back()
            ->withInput($request->only('username', 'tipo'))
            ->withErrors(['username' => 'Correo o contraseña incorrectos.']);
    }
}
