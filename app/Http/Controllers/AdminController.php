<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Profesor;
use App\Models\Personal;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function registrarUsuario(Request $request)
    {
        // Validar el tipo de usuario primero
        $validatorTipo = Validator::make($request->all(), [
            'tipo_usuario' => 'required|string|in:alumno,profesor,personal',
        ]);

        if ($validatorTipo->fails()) {
            return response()->json(['errors' => $validatorTipo->errors()], 422);
        }

        $tipo = $request->tipo_usuario;

        $rules = [
            'nombre' => 'required|string|max:50',
            'apellido_p' => 'required|string|max:50',
            'email' => "required|email|unique:{$tipo},email|max:100",
            'contraseña' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'estado_residencia' => 'required|string|max:50',
            'ciudad' => 'required|string|max:50',
            'calle' => 'required|string|max:255',
            'codigo_postal' => 'required|integer',
            'genero' => 'required|string|in:f,m,o,F,M,O',
            'fecha_nacimiento' => 'required|date',
        ];

        // Definir reglas específicas
        if ($tipo === 'alumno') {
            $rules['id_tutor'] = 'nullable|integer';
            $rules['id_sede'] = 'required|integer';
        } elseif ($tipo === 'profesor') {
            $rules['id_sede'] = 'required|integer';
        } elseif ($tipo === 'personal') {
            $rules['id_rol'] = 'required|integer';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Asignación de propiedades manualmente respetando modelos existentes
        if ($tipo === 'alumno') {
            $usuario = new Alumno();
            
            if ($request->filled('tu_nombre')) {
                $tutor = new \App\Models\Tutor();
                $tutor->nombre = $request->tu_nombre;
                $tutor->apellido_p = $request->tu_ap_paterno;
                $tutor->apellido_m = $request->tu_ap_materno;
                $tutor->parentesco = $request->tu_parentesco;
                $tutor->telefono = $request->tu_telefono;
                $tutor->email = $request->tu_correo;
                $tutor->save();
                
                $usuario->id_tutor = $tutor->id_tutor;
            } elseif ($request->has('id_tutor')) {
                $usuario->id_tutor = $request->id_tutor;
            }
            
            $usuario->id_sede = $request->id_sede;
            $usuario->puntaje = $request->puntos ?? 0;
        } elseif ($tipo === 'profesor') {
            $usuario = new Profesor();
            $usuario->id_sede = $request->id_sede;
        } elseif ($tipo === 'personal') {
            $usuario = new Personal();
            $usuario->id_rol = $request->id_rol;
        }

        $usuario->nombre = $request->nombre;
        $usuario->apellido_p = $request->apellido_p;
        
        if ($request->filled('apellido_m')) {
            $usuario->apellido_m = $request->apellido_m;
        }
        
        if ($request->filled('estado_residencia')) $usuario->estado_residencia = $request->estado_residencia;
        if ($request->filled('ciudad')) $usuario->ciudad = $request->ciudad;
        if ($request->filled('calle')) $usuario->calle = substr($request->calle, 0, 255);
        if ($request->filled('codigo_postal')) $usuario->codigo_postal = $request->codigo_postal;
        if ($request->filled('genero')) $usuario->genero = strtolower($request->genero);
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        if ($request->filled('telefono')) $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->contraseña = Hash::make($request->input('contraseña'));
        $usuario->estatus = $request->input('estatus', true);

        $usuario->save();

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'usuario' => $usuario
        ], 201);
    }

    public function editarUsuario(Request $request, $tipo, $id)
    {
        if (!in_array($tipo, ['alumno', 'profesor', 'personal'])) {
            return response()->json(['error' => 'Tipo de usuario inválido'], 400);
        }

        $usuario = null;
        if ($tipo === 'alumno') $usuario = Alumno::find($id);
        elseif ($tipo === 'profesor') $usuario = Profesor::find($id);
        elseif ($tipo === 'personal') $usuario = Personal::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $rules = [
            'nombre' => 'sometimes|required|string|max:50',
            'apellido_p' => 'sometimes|required|string|max:50',
            'email' => "sometimes|required|email|max:100|unique:{$tipo},email,{$id},id_{$tipo}",
            'contraseña' => 'nullable|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'estado_residencia' => 'sometimes|required|string|max:50',
            'ciudad' => 'sometimes|required|string|max:50',
            'calle' => 'sometimes|required|string|max:255',
            'codigo_postal' => 'sometimes|required|integer',
            'genero' => 'sometimes|required|string|in:f,m,o,F,M,O',
            'fecha_nacimiento' => 'sometimes|required|date'
        ];

        if ($tipo === 'alumno') {
            $rules['id_tutor'] = 'nullable|integer';
            $rules['id_sede'] = 'nullable|integer';
            $rules['puntaje'] = 'nullable|integer';
        } elseif ($tipo === 'profesor') {
            $rules['id_sede'] = 'nullable|integer';
            $rules['puntaje'] = 'nullable|integer';
        } elseif ($tipo === 'personal') {
            $rules['id_rol'] = 'nullable|integer';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fillableFields = [
            'nombre', 'apellido_p', 'apellido_m', 'estado_residencia', 'ciudad',
            'calle', 'codigo_postal', 'genero', 'fecha_nacimiento', 'telefono',
            'email', 'estatus'
        ];

        if ($tipo === 'alumno') $fillableFields[] = 'puntaje';
        if ($tipo === 'profesor') $fillableFields[] = 'puntaje';

        foreach ($fillableFields as $field) {
            if ($request->has($field)) {
                // Convertir género a minúscula para el enum de PostgreSQL
                if ($field === 'genero') {
                    $usuario->genero = strtolower($request->$field);
                } elseif ($field === 'calle') {
                    $usuario->calle = substr($request->$field, 0, 255);
                } else {
                    $usuario->$field = $request->$field;
                }
            }
        }

        if ($request->filled('contraseña')) {
            $usuario->contraseña = Hash::make($request->contraseña);
        }

        if ($tipo === 'alumno' && $request->has('id_tutor')) {
            $usuario->id_tutor = $request->id_tutor;
        }
        if (in_array($tipo, ['alumno', 'profesor']) && $request->has('id_sede')) {
            $usuario->id_sede = $request->id_sede;
        }
        if ($tipo === 'personal' && $request->has('id_rol')) {
            $usuario->id_rol = $request->id_rol;
        }

        $usuario->save();

        return response()->json([
            'message' => ucfirst($tipo) . ' actualizado exitosamente',
            'usuario' => $usuario
        ]);
    }

    public function eliminarUsuario($tipo, $id)
    {
        if (!in_array($tipo, ['alumno', 'profesor', 'personal'])) {
            return response()->json(['error' => 'Tipo de usuario inválido'], 400);
        }

        $usuario = null;
        if ($tipo === 'alumno') $usuario = Alumno::find($id);
        elseif ($tipo === 'profesor') $usuario = Profesor::find($id);
        elseif ($tipo === 'personal') $usuario = Personal::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json([
            'message' => ucfirst($tipo) . ' eliminado exitosamente'
        ]);
    }

    // -------------------------------------------------------
    // GET /admin/obtener/{tipo}/{id}
    // Devuelve un registro fresco de la DB para el modal editar
    // -------------------------------------------------------
    public function obtenerUsuario($tipo, $id)
    {
        if (!in_array($tipo, ['alumno', 'profesor', 'personal'])) {
            return response()->json(['error' => 'Tipo inválido'], 400);
        }

        $usuario = match($tipo) {
            'alumno'   => Alumno::find($id),
            'profesor' => Profesor::find($id),
            'personal' => Personal::find($id),
        };

        if (!$usuario) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        return response()->json($usuario);
    }

    // -------------------------------------------------------
    // GET /admin/buscar/{tipo}?q=&id_sede=&estatus=&nivel=&id_rol=
    // Devuelve filas filtradas en JSON para re-render de tabla
    // -------------------------------------------------------
    public function buscarUsuarios(Request $request, $tipo)
    {
        if (!in_array($tipo, ['alumno', 'profesor', 'personal'])) {
            return response()->json(['error' => 'Tipo inválido'], 400);
        }

        $q       = $request->query('q', '');
        $idSede  = $request->query('id_sede', '');
        $estatus = $request->query('estatus', '');
        $nivel   = $request->query('nivel', '');   // solo alumnos
        $idRol   = $request->query('id_rol', '');  // solo personal

        $query = match($tipo) {
            'alumno'   => Alumno::leftJoin('sede', 'alumno.id_sede', '=', 'sede.id_sede')
                              ->select('alumno.*', 'sede.nombre as nombre_sede'),
            'profesor' => Profesor::leftJoin('sede', 'profesor.id_sede', '=', 'sede.id_sede')
                              ->select('profesor.*', 'sede.nombre as nombre_sede'),
            'personal' => Personal::leftJoin('rol', 'personal.id_rol', '=', 'rol.id_rol')
                              ->select('personal.*', 'rol.nombre as nombre_rol'),
        };

        // Búsqueda de texto: nombre, apellidos, email
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->whereRaw("LOWER(nombre) LIKE ?", ["%{$q}%"])
                    ->orWhereRaw("LOWER(apellido_p) LIKE ?", ["%{$q}%"])
                    ->orWhereRaw("LOWER(apellido_m) LIKE ?", ["%{$q}%"])
                    ->orWhereRaw("LOWER(email) LIKE ?", ["%{$q}%"]);
            });
        }

        // Filtro sede
        if ($idSede !== '') {
            $query->where('id_sede', (int) $idSede);
        }

        // Filtro estatus (acepta 'activo'/'inactivo' o 'true'/'false' o '1'/'0')
        if ($estatus !== '') {
            $esActivo = in_array($estatus, ['activo', 'true', '1'], true);
            $query->where('estatus', $esActivo);
        }

        // Filtro nivel (alumnos: basado en puntaje)
        if ($tipo === 'alumno' && $nivel !== '') {
            match($nivel) {
                'principiante' => $query->where('puntaje', '<', 500),
                'intermedio'   => $query->whereBetween('puntaje', [500, 999]),
                'avanzado'     => $query->where('puntaje', '>=', 1000),
                default        => null,
            };
        }

        // Filtro rol (personal)
        if ($tipo === 'personal' && $idRol !== '') {
            $query->where('id_rol', (int) $idRol);
        }

        $resultados = $query->get();

        // Formatear respuesta para el frontend
        $filas = $resultados->map(function ($r) use ($tipo) {
            $base = [
                'id'        => $r->{"id_{$tipo}"},
                'nombre'    => trim("{$r->nombre} {$r->apellido_p} " . ($r->apellido_m ?? '')),
                'email'     => $r->email,
                'estatus'   => $r->estatus,
                'info'      => $r->toArray(),
            ];

            if ($tipo === 'alumno') {
                $edad = \Carbon\Carbon::parse($r->fecha_nacimiento)->age;
                $nivel = $r->puntaje < 500 ? 'Principiante' : ($r->puntaje < 1000 ? 'Intermedio' : 'Avanzado');
                $base['edad']    = $edad;
                $base['nivel']   = $nivel;
                $base['id_sede'] = $r->id_sede;
            } elseif ($tipo === 'profesor') {
                $base['id_sede'] = $r->id_sede;
                $base['puntaje'] = $r->puntaje;
            } elseif ($tipo === 'personal') {
                $base['id_rol']     = $r->id_rol;
                $base['nombre_rol'] = $r->nombre_rol ?? '';
            }

            return $base;
        });

        return response()->json(['total' => $filas->count(), 'data' => $filas]);
    }
}
