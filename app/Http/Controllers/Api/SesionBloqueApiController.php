<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesionBloqueApiController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('sesion_bloque as sb')
            ->join('sesion_entrenamiento as se', 'se.id', '=', 'sb.id_sesion_entrenamiento')
            ->join('bloque_entrenamiento as be', 'be.id', '=', 'sb.id_bloque_entrenamiento')
            ->select(
                'sb.id',
                'sb.id_sesion_entrenamiento',
                'sb.id_bloque_entrenamiento',
                'sb.orden',
                'sb.repeticiones',
                'se.nombre as sesion_nombre',
                'se.fecha as sesion_fecha',
                'be.nombre as bloque_nombre',
                'be.tipo as bloque_tipo'
            )
            ->orderBy('sb.id', 'desc');

        if ($request->filled('id_sesion_entrenamiento')) {
            $query->where('sb.id_sesion_entrenamiento', (int) $request->query('id_sesion_entrenamiento'));
        }

        if ($request->filled('id_bloque_entrenamiento')) {
            $query->where('sb.id_bloque_entrenamiento', (int) $request->query('id_bloque_entrenamiento'));
        }

        return response()->json(['data' => $query->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_sesion_entrenamiento' => ['required', 'integer', 'exists:sesion_entrenamiento,id'],
            'id_bloque_entrenamiento' => ['required', 'integer', 'exists:bloque_entrenamiento,id'],
            'orden' => ['required', 'integer', 'min:1'],
            'repeticiones' => ['nullable', 'integer', 'min:1'],
        ]);

        $validated['repeticiones'] = $validated['repeticiones'] ?? 1;

        $id = DB::table('sesion_bloque')->insertGetId($validated);
        $sesionBloque = DB::table('sesion_bloque')->where('id', $id)->first();

        return response()->json(['data' => $sesionBloque], 201);
    }

    public function show($id)
    {
        $sesionBloque = DB::table('sesion_bloque as sb')
            ->join('sesion_entrenamiento as se', 'se.id', '=', 'sb.id_sesion_entrenamiento')
            ->join('bloque_entrenamiento as be', 'be.id', '=', 'sb.id_bloque_entrenamiento')
            ->select(
                'sb.id',
                'sb.id_sesion_entrenamiento',
                'sb.id_bloque_entrenamiento',
                'sb.orden',
                'sb.repeticiones',
                'se.nombre as sesion_nombre',
                'se.fecha as sesion_fecha',
                'be.nombre as bloque_nombre',
                'be.tipo as bloque_tipo'
            )
            ->where('sb.id', (int) $id)
            ->first();

        if (!$sesionBloque) {
            return response()->json(['message' => 'Sesion-bloque no encontrada.'], 404);
        }

        return response()->json(['data' => $sesionBloque]);
    }

    public function update(Request $request, $id)
    {
        $sesionBloque = DB::table('sesion_bloque')->where('id', (int) $id)->first();
        if (!$sesionBloque) {
            return response()->json(['message' => 'Sesion-bloque no encontrada.'], 404);
        }

        $validated = $request->validate([
            'id_sesion_entrenamiento' => ['required', 'integer', 'exists:sesion_entrenamiento,id'],
            'id_bloque_entrenamiento' => ['required', 'integer', 'exists:bloque_entrenamiento,id'],
            'orden' => ['required', 'integer', 'min:1'],
            'repeticiones' => ['nullable', 'integer', 'min:1'],
        ]);

        $validated['repeticiones'] = $validated['repeticiones'] ?? 1;

        DB::table('sesion_bloque')->where('id', (int) $id)->update($validated);
        $updated = DB::table('sesion_bloque')->where('id', (int) $id)->first();

        return response()->json(['data' => $updated]);
    }

    public function destroy($id)
    {
        $sesionBloque = DB::table('sesion_bloque')->where('id', (int) $id)->first();
        if (!$sesionBloque) {
            return response()->json(['message' => 'Sesion-bloque no encontrada.'], 404);
        }

        try {
            DB::table('sesion_bloque')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'No se pudo eliminar la sesion de bloque.',
            ], 409);
        }

        return response()->json(['message' => 'Sesion-bloque eliminada correctamente.']);
    }
}
