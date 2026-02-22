<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadoApiController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('entrenamiento as e')
            ->leftJoin('bicicleta as b', 'b.id', '=', 'e.id_bicicleta')
            ->leftJoin('sesion_entrenamiento as se', 'se.id', '=', 'e.id_sesion')
            ->select(
                'e.id',
                'e.id_ciclista',
                'e.id_bicicleta',
                'e.id_sesion',
                'e.fecha',
                'e.duracion',
                'e.kilometros',
                'e.recorrido',
                'e.pulso_medio',
                'e.pulso_max',
                'e.potencia_media',
                'e.potencia_normalizada',
                'e.velocidad_media',
                'e.puntos_estres_tss',
                'e.factor_intensidad_if',
                'e.ascenso_metros',
                'e.comentario',
                'b.nombre as bicicleta_nombre',
                'b.tipo as bicicleta_tipo',
                'se.nombre as sesion_nombre'
            )
            ->orderBy('e.id', 'desc');

        if ($request->filled('id_sesion')) {
            $query->where('e.id_sesion', (int) $request->query('id_sesion'));
        }

        if ($request->filled('id_ciclista')) {
            $query->where('e.id_ciclista', (int) $request->query('id_ciclista'));
        }

        return response()->json(['data' => $query->get()]);
    }

    public function bySesion($id)
    {
        $sesion = DB::table('sesion_entrenamiento')->where('id', (int) $id)->first();
        if (!$sesion) {
            return response()->json(['message' => 'Sesion no encontrada.'], 404);
        }

        $resultados = DB::table('entrenamiento as e')
            ->leftJoin('bicicleta as b', 'b.id', '=', 'e.id_bicicleta')
            ->select(
                'e.id',
                'e.id_ciclista',
                'e.id_bicicleta',
                'e.id_sesion',
                'e.fecha',
                'e.duracion',
                'e.kilometros',
                'e.recorrido',
                'e.pulso_medio',
                'e.pulso_max',
                'e.potencia_media',
                'e.potencia_normalizada',
                'e.velocidad_media',
                'e.puntos_estres_tss',
                'e.factor_intensidad_if',
                'e.ascenso_metros',
                'e.comentario',
                'b.nombre as bicicleta_nombre',
                'b.tipo as bicicleta_tipo'
            )
            ->where('e.id_sesion', (int) $id)
            ->orderBy('e.id', 'desc')
            ->get();

        return response()->json([
            'sesion' => $sesion,
            'data' => $resultados,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ciclista' => ['required', 'integer', 'exists:ciclista,id'],
            'id_bicicleta' => ['required', 'integer', 'exists:bicicleta,id'],
            'id_sesion' => ['nullable', 'integer', 'exists:sesion_entrenamiento,id'],
            'fecha' => ['required', 'date'],
            'duracion' => ['required', 'date_format:H:i'],
            'kilometros' => ['required', 'numeric', 'between:0,9999.99'],
            'recorrido' => ['required', 'string', 'max:150'],
            'pulso_medio' => ['nullable', 'integer', 'min:0', 'max:300'],
            'pulso_max' => ['nullable', 'integer', 'min:0', 'max:300'],
            'potencia_media' => ['nullable', 'integer', 'min:0'],
            'potencia_normalizada' => ['required', 'integer', 'min:0'],
            'velocidad_media' => ['required', 'numeric', 'between:0,999.99'],
            'puntos_estres_tss' => ['nullable', 'numeric', 'between:0,9999.99'],
            'factor_intensidad_if' => ['nullable', 'numeric', 'between:0,9.999'],
            'ascenso_metros' => ['nullable', 'integer', 'min:0'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);

        $insertData = $validated;
        $insertData['duracion'] = $validated['duracion'] . ':00';

        $id = DB::table('entrenamiento')->insertGetId($insertData);
        $resultado = DB::table('entrenamiento')->where('id', $id)->first();

        return response()->json(['data' => $resultado], 201);
    }

    public function show($id)
    {
        $resultado = DB::table('entrenamiento as e')
            ->leftJoin('bicicleta as b', 'b.id', '=', 'e.id_bicicleta')
            ->leftJoin('sesion_entrenamiento as se', 'se.id', '=', 'e.id_sesion')
            ->select(
                'e.id',
                'e.id_ciclista',
                'e.id_bicicleta',
                'e.id_sesion',
                'e.fecha',
                'e.duracion',
                'e.kilometros',
                'e.recorrido',
                'e.pulso_medio',
                'e.pulso_max',
                'e.potencia_media',
                'e.potencia_normalizada',
                'e.velocidad_media',
                'e.puntos_estres_tss',
                'e.factor_intensidad_if',
                'e.ascenso_metros',
                'e.comentario',
                'b.nombre as bicicleta_nombre',
                'b.tipo as bicicleta_tipo',
                'se.nombre as sesion_nombre'
            )
            ->where('e.id', (int) $id)
            ->first();

        if (!$resultado) {
            return response()->json(['message' => 'Resultado no encontrado.'], 404);
        }

        return response()->json(['data' => $resultado]);
    }

    public function update(Request $request, $id)
    {
        $resultado = DB::table('entrenamiento')->where('id', (int) $id)->first();
        if (!$resultado) {
            return response()->json(['message' => 'Resultado no encontrado.'], 404);
        }

        $validated = $request->validate([
            'id_ciclista' => ['required', 'integer', 'exists:ciclista,id'],
            'id_bicicleta' => ['required', 'integer', 'exists:bicicleta,id'],
            'id_sesion' => ['nullable', 'integer', 'exists:sesion_entrenamiento,id'],
            'fecha' => ['required', 'date'],
            'duracion' => ['required', 'date_format:H:i'],
            'kilometros' => ['required', 'numeric', 'between:0,9999.99'],
            'recorrido' => ['required', 'string', 'max:150'],
            'pulso_medio' => ['nullable', 'integer', 'min:0', 'max:300'],
            'pulso_max' => ['nullable', 'integer', 'min:0', 'max:300'],
            'potencia_media' => ['nullable', 'integer', 'min:0'],
            'potencia_normalizada' => ['required', 'integer', 'min:0'],
            'velocidad_media' => ['required', 'numeric', 'between:0,999.99'],
            'puntos_estres_tss' => ['nullable', 'numeric', 'between:0,9999.99'],
            'factor_intensidad_if' => ['nullable', 'numeric', 'between:0,9.999'],
            'ascenso_metros' => ['nullable', 'integer', 'min:0'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);

        $updateData = $validated;
        $updateData['duracion'] = $validated['duracion'] . ':00';

        DB::table('entrenamiento')->where('id', (int) $id)->update($updateData);
        $updated = DB::table('entrenamiento')->where('id', (int) $id)->first();

        return response()->json(['data' => $updated]);
    }

    public function destroy($id)
    {
        $resultado = DB::table('entrenamiento')->where('id', (int) $id)->first();
        if (!$resultado) {
            return response()->json(['message' => 'Resultado no encontrado.'], 404);
        }

        try {
            DB::table('entrenamiento')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'No se pudo eliminar el resultado.',
            ], 409);
        }

        return response()->json(['message' => 'Resultado eliminado correctamente.']);
    }
}
