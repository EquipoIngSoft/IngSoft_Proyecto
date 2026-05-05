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
        if (!$token)
            return null;

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken || !($accessToken->tokenable instanceof Alumno))
            return null;

        return $accessToken->tokenable;
    }

    /**
     * Convierte el umbral de puntaje almacenado en cursos.nivel
     * al nombre de la pieza de ajedrez correspondiente.
     */
    private static function nivelNombre(int $umbral): string
    {
        return match (true) {
            $umbral >= 3000 => '♚ Rey',
            $umbral >= 1500 => '♛ Reina',
            $umbral >= 800 => '♜ Torre',
            $umbral >= 400 => '♝ Alfil',
            $umbral >= 150 => '♞ Caballo',
            default => '♟ Peón',
        };
    }

    public function index()
    {
        $alumno = $this->getAlumnoActual();
        if (!$alumno)
            return response()->json(['error' => 'No autenticado'], 401);

        // Fetch user's enrolled groups
        $misInscripciones = DB::table('inscripcion')
            ->where('id_alumno', $alumno->id_alumno)
            ->where('estatus', true)
            ->pluck('id_grupo')
            ->toArray();

        $misGrupos = \App\Models\Academico\Grupo::with(['curso', 'profesor', 'horarios'])
            ->whereIn('id_grupo', $misInscripciones)
            ->get()
            ->map(function ($g) {
                $nivelDB = $g->curso ? (int) $g->curso->nivel : 0;
                return [
                    'id_grupo' => $g->id_grupo,
                    'curso_nombre' => $g->curso ? $g->curso->nombre : 'Sin curso',
                    'nivel' => self::nivelNombre($nivelDB),
                    'nivel_puntaje' => $nivelDB,
                    'profesor_nombre' => $g->profesor ? $g->profesor->nombre : 'Sin',
                    'profesor_apellido' => $g->profesor ? $g->profesor->apellido_p : 'asignar',
                    'horarios' => $g->horarios,
                    'inscrito' => true,
                    'cupo_actual' => $g->cupo_actual,
                    'cupo_maximo' => $g->cupo_maximo,
                ];
            });

        // El puntaje del alumno determina qué cursos puede ver:
        // Solo los grupos cuyo curso.nivel (umbral mínimo) sea <= puntaje del alumno
        $puntaje = $alumno->puntaje ?? 0;

        $gruposDisponibles = \App\Models\Academico\Grupo::with(['curso', 'profesor', 'horarios'])
            ->whereNotIn('id_grupo', $misInscripciones)
            ->where('estatus', true)
            ->whereHas('curso', function ($q) use ($puntaje) {
                $q->where('nivel', '<=', $puntaje);
            })
            ->get()
            ->map(function ($g) {
                $nivelDB = $g->curso ? (int) $g->curso->nivel : 0;
                return [
                    'id_grupo' => $g->id_grupo,
                    'curso_nombre' => $g->curso ? $g->curso->nombre : 'Sin curso',
                    'nivel' => self::nivelNombre($nivelDB),
                    'nivel_puntaje' => $nivelDB,
                    'profesor_nombre' => $g->profesor ? $g->profesor->nombre : 'Sin',
                    'profesor_apellido' => $g->profesor ? $g->profesor->apellido_p : 'asignar',
                    'horarios' => $g->horarios,
                    'cupo_actual' => $g->cupo_actual,
                    'cupo_maximo' => $g->cupo_maximo,
                    'inscrito' => false,
                    'cupo_lleno' => $g->cupo_actual >= $g->cupo_maximo,
                ];
            });

        return response()->json([
            'mis_grupos' => $misGrupos,
            'grupos_disponibles' => $gruposDisponibles,
            'nivel_alumno' => $puntaje,
            'nivel_nombre' => self::nivelNombre($puntaje),
        ]);
    }

    public function accion(Request $request, $id, $accion)
    {
        $alumno = $this->getAlumnoActual();
        if (!$alumno)
            return response()->json(['message' => 'No autenticado'], 401);

        $grupo = DB::table('grupo')->where('id_grupo', $id)->first();
        if (!$grupo)
            return response()->json(['message' => 'Grupo no encontrado'], 404);

        if ($accion === 'inscribir') {
            if ($grupo->cupo_actual >= $grupo->cupo_maximo) {
                return response()->json(['message' => 'El grupo está lleno.'], 400);
            }

            $yaInscrito = DB::table('inscripcion')
                ->where('id_alumno', $alumno->id_alumno)
                ->where('id_grupo', $id)
                ->where('estatus', true)
                ->exists();

            if ($yaInscrito)
                return response()->json(['message' => 'Ya estás inscrito en este grupo.'], 400);

            DB::table('inscripcion')->insert([
                'id_alumno' => $alumno->id_alumno,
                'id_grupo' => $id,
                'fecha_asignacion' => now(),
                'estatus' => true
            ]);

            DB::table('grupo')->where('id_grupo', $id)->increment('cupo_actual');

            return response()->json(['message' => '¡Te has inscrito al grupo exitosamente!']);

        } elseif ($accion === 'cancelar') {
            // Verificar que existe una inscripción activa
            $inscripcion = DB::table('inscripcion')
                ->where('id_alumno', $alumno->id_alumno)
                ->where('id_grupo', $id)
                ->where('estatus', true)
                ->first();

            if (!$inscripcion) {
                return response()->json(['message' => 'No tienes una inscripción activa en este grupo.'], 400);
            }

            // Dar de baja sin eliminar: solo cambia estatus y registra fecha_baja
            DB::table('inscripcion')
                ->where('id_alumno', $alumno->id_alumno)
                ->where('id_grupo', $id)
                ->where('estatus', true)
                ->update([
                    'estatus' => false,
                    'fecha_baja' => now(),
                    'motivo_baja' => $request->input('motivo_baja', 'Cancelación voluntaria'),
                ]);

            DB::table('grupo')->where('id_grupo', $id)->decrement('cupo_actual');

            return response()->json(['message' => 'Se canceló tu inscripción al grupo.']);
        }

        return response()->json(['message' => 'Acción inválida'], 400);
    }
}
