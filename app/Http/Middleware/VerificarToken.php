<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class VerificarToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login');
        }

        $tokenHash = hash('sha256', explode('|', $token)[1] ?? $token);
        $tokenValido = PersonalAccessToken::where('token', $tokenHash)->first();

        if (!$tokenValido || ($tokenValido->expires_at && $tokenValido->expires_at < now())) {
            session()->forget('token');
            return redirect()->route('login');
        }

        return $next($request);
    }
}