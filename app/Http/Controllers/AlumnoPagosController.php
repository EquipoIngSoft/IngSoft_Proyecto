<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Alumno;
use App\Models\Factura;

class AlumnoPagosController extends Controller
{
    private function getAlumnoActual(): ?Alumno
    {
        $token = session('token');
        if (!$token) return null;

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken || !($accessToken->tokenable instanceof Alumno))
            return null;

        return $accessToken->tokenable;
    }

    public function index()
    {
        $alumno = $this->getAlumnoActual();
        if (!$alumno) return response()->json(['error' => 'No autenticado'], 401);

        // Update expired invoices
        Factura::where('id_alumno', $alumno->id_alumno)
            ->where('vigencia', 'enproceso')
            ->where('fecha_limite', '<', now())
            ->update(['vigencia' => 'expirado']);

        $facturas = Factura::where('id_alumno', $alumno->id_alumno)
            ->orderBy('fecha_emision', 'desc')
            ->get();

        $sede = DB::table('sede')->where('id_sede', $alumno->id_sede)->first();

        return response()->json([
            'facturas' => $facturas,
            'sede' => $sede
        ]);
    }
}
