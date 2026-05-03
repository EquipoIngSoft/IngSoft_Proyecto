<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Alumno;

class AlumnoGruposController extends Controller
{
    private function getAlumnoActual(): ?Alumno
    {
        $token = session('token');
        if (!$token) return null;

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken || !($accessToken->tokenable instanceof Alumno)) return null;

        return $accessToken->tokenable;
    }

    public function index()
    {
        $alumno = $this->getAlumnoActual();
        if (!$alumno) return response()->json(['error' => 'No autenticado'], 401);

        // Fetch user's enrolled groups
        $misInscripciones = DB::table('inscripcion')
            ->where('id_alumno', $alumno->id_alumno)
            ->where('estatus', true)
            ->pluck('id_grupo')
            ->toArray();

        $misGrupos = \App\Models\Academico\Grupo::with(['curso', 'profesor', 'horarios'])
            ->whereIn('id_grupo', $misInscripciones)
            ->get()
            ->map(function($g) {
                $nivelMap = ['Principiante' => 'Nivel 1', 'Intermedio' => 'Nivel 2', 'Avanzado' => 'Nivel 3'];
                $nivelDB = $g->curso ? $g->curso->nivel : 'N/A';
                return [
                    'id_grupo' => $g->id_grupo,
                    'curso_nombre' => $g->curso ? $g->curso->nombre : 'Sin curso',
                    'nivel' => $nivelMap[$nivelDB] ?? $nivelDB,
                    'profesor_nombre' => $g->profesor ? $g->profesor->nombre : 'Sin',
                    'profesor_apellido' => $g->profesor ? $g->profesor->apellido_p : 'asignar',
                    'horarios' => $g->horarios,
                    'inscrito' => true,
                    'cupo_actual' => $g->cupo_actual,
                    'cupo_maximo' => $g->cupo_maximo
                ];
            });

        // Determinar el nivel del alumno usando los mismos umbrales que AlumnoController
        $puntaje = $alumno->puntaje ?? 0;
        $nivelNumero = match (true) {
            $puntaje >= 3000 => 6,
            $puntaje >= 1500 => 5,
            $puntaje >= 800  => 4,
            $puntaje >= 400  => 3,
            $puntaje >= 150  => 2,
            default          => 1,
        };

        // Mapear el nivel numérico a los niveles de curso (Principiante, Intermedio, Avanzado)
        $nivelesPermitidos = [];
        if ($nivelNumero >= 1) $nivelesPermitidos[] = 'Principiante';
        if ($nivelNumero >= 2) $nivelesPermitidos[] = 'Intermedio';
        if ($nivelNumero >= 3) $nivelesPermitidos[] = 'Avanzado';

        $gruposDisponibles = \App\Models\Academico\Grupo::with(['curso', 'profesor', 'horarios'])
            ->whereNotIn('id_grupo', $misInscripciones)
            ->where('estatus', true)
            ->whereHas('curso', function ($q) use ($nivelesPermitidos) {
                $q->whereIn('nivel', $nivelesPermitidos);
            })
            ->get()
            ->map(function($g) {
                $nivelMap = ['Principiante' => 'Nivel 1', 'Intermedio' => 'Nivel 2', 'Avanzado' => 'Nivel 3'];
                $nivelDB = $g->curso ? $g->curso->nivel : 'N/A';
                return [
                    'id_grupo' => $g->id_grupo,
                    'curso_nombre' => $g->curso ? $g->curso->nombre : 'Sin curso',
                    'nivel' => $nivelMap[$nivelDB] ?? $nivelDB,
                    'profesor_nombre' => $g->profesor ? $g->profesor->nombre : 'Sin',
                    'profesor_apellido' => $g->profesor ? $g->profesor->apellido_p : 'asignar',
                    'horarios' => $g->horarios,
                    'cupo_actual' => $g->cupo_actual,
                    'cupo_maximo' => $g->cupo_maximo,
                    'inscrito' => false,
                    'cupo_lleno' => $g->cupo_actual >= $g->cupo_maximo
                ];
            });

        return response()->json([
            'mis_grupos'         => $misGrupos,
            'grupos_disponibles' => $gruposDisponibles,
            'nivel_alumno'       => $nivelNumero,
        ]);
    }

    public function accion(Request $request, $id, $accion)
    {
        $alumno = $this->getAlumnoActual();
        if (!$alumno) return response()->json(['message' => 'No autenticado'], 401);

        $grupo = DB::table('grupo')->where('id_grupo', $id)->first();
        if (!$grupo) return response()->json(['message' => 'Grupo no encontrado'], 404);

        if ($accion === 'inscribir') {
            if ($grupo->cupo_actual >= $grupo->cupo_maximo) {
                return response()->json(['message' => 'El grupo está lleno.'], 400);
            }

            $yaInscrito = DB::table('inscripcion')
                ->where('id_alumno', $alumno->id_alumno)
                ->where('id_grupo', $id)
                ->where('estatus', true)
                ->exists();

            if ($yaInscrito) return response()->json(['message' => 'Ya estás inscrito en este grupo.'], 400);

            DB::table('inscripcion')->insert([
                'id_alumno' => $alumno->id_alumno,
                'id_grupo' => $id,
                'fecha_asignacion' => now(),
                'estatus' => true
            ]);

            DB::table('grupo')->where('id_grupo', $id)->increment('cupo_actual');

            return response()->json(['message' => '¡Te has inscrito al grupo exitosamente!']);

        } elseif ($accion === 'cancelar') {
            $deleted = DB::table('inscripcion')
                ->where('id_alumno', $alumno->id_alumno)
                ->where('id_grupo', $id)
                ->delete();

            if ($deleted) {
                DB::table('grupo')->where('id_grupo', $id)->decrement('cupo_actual');
                return response()->json(['message' => 'Se canceló tu inscripción al grupo.']);
            }

            return response()->json(['message' => 'No estabas inscrito en este grupo.'], 400);
        }

        return response()->json(['message' => 'Acción inválida'], 400);
    }
}
