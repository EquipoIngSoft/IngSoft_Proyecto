<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumno;
use App\Models\Personal;
use App\Models\Profesor;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('logIn');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|min:6',
            'tipo' => 'required|in:alumno,personal',
        ], [
            'username.required' => 'El correo es obligatorio.',
            'username.email' => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $email = $request->input('username');
        $password = $request->input('password');
        $tipo = $request->input('tipo');

        if ($tipo === 'alumno') {
            $usuario = Alumno::where('email', $email)->where('estatus', true)->first();
        } else {
            $usuario = Personal::where('email', $email)->where('estatus', true)->first()
                ?? Profesor::where('email', $email)->where('estatus', true)->first();
        }

        if (!$usuario || !Hash::check($password, $usuario->getAuthPassword())) {
            return response()->json(['message' => 'Correo o contraseña incorrectos.'], 401);
        }

        $tipo = match (true) {
            $usuario instanceof Alumno => 'alumno',
            $usuario instanceof Profesor => 'profesor',
            $usuario instanceof Personal => 'personal',
        };

        $token = $usuario->createToken('api-token', expiresAt: now()->addMinutes(config('sanctum.expiration')))->plainTextToken;

        return response()->json([
            'token' => $token,
            'tipo' => $tipo,
            'usuario' => $usuario,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}