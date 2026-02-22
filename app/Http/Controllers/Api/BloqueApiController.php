<?php

namespace App\Http\Controllers\Api;

use App\BloqueEntrenamiento;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BloqueApiController extends Controller
{
    public function index()
    {
        $bloques = BloqueEntrenamiento::orderBy('id', 'desc')->get();

        return response()->json(['data' => $bloques]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'tipo' => ['required', 'in:rodaje,intervalos,fuerza,recuperacion,test'],
            'duracion_estimada' => ['nullable', 'date_format:H:i'],
            'potencia_pct_min' => ['nullable', 'numeric', 'between:0,999.99'],
            'potencia_pct_max' => ['nullable', 'numeric', 'between:0,999.99'],
            'pulso_pct_max' => ['nullable', 'numeric', 'between:0,999.99'],
            'pulso_reserva_pct' => ['nullable', 'numeric', 'between:0,999.99'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);

        if (!empty($validated['duracion_estimada'])) {
            $validated['duracion_estimada'] .= ':00';
        }

        if (
            isset($validated['potencia_pct_min'], $validated['potencia_pct_max']) &&
            $validated['potencia_pct_min'] > $validated['potencia_pct_max']
        ) {
            return response()->json([
                'message' => 'La potencia minima no puede ser mayor que la maxima.',
            ], 422);
        }

        $bloque = BloqueEntrenamiento::create($validated);

        return response()->json(['data' => $bloque], 201);
    }

    public function show($id)
    {
        $bloque = BloqueEntrenamiento::find((int) $id);
        if (!$bloque) {
            return response()->json(['message' => 'Bloque no encontrado.'], 404);
        }

        return response()->json(['data' => $bloque]);
    }

    public function update(Request $request, $id)
    {
        $bloque = BloqueEntrenamiento::find((int) $id);
        if (!$bloque) {
            return response()->json(['message' => 'Bloque no encontrado.'], 404);
        }

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'tipo' => ['required', 'in:rodaje,intervalos,fuerza,recuperacion,test'],
            'duracion_estimada' => ['nullable', 'date_format:H:i'],
            'potencia_pct_min' => ['nullable', 'numeric', 'between:0,999.99'],
            'potencia_pct_max' => ['nullable', 'numeric', 'between:0,999.99'],
            'pulso_pct_max' => ['nullable', 'numeric', 'between:0,999.99'],
            'pulso_reserva_pct' => ['nullable', 'numeric', 'between:0,999.99'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);

        if (!empty($validated['duracion_estimada'])) {
            $validated['duracion_estimada'] .= ':00';
        }

        if (
            isset($validated['potencia_pct_min'], $validated['potencia_pct_max']) &&
            $validated['potencia_pct_min'] > $validated['potencia_pct_max']
        ) {
            return response()->json([
                'message' => 'La potencia minima no puede ser mayor que la maxima.',
            ], 422);
        }

        $bloque->update($validated);

        return response()->json(['data' => $bloque->fresh()]);
    }

    public function destroy($id)
    {
        $bloque = BloqueEntrenamiento::find((int) $id);
        if (!$bloque) {
            return response()->json(['message' => 'Bloque no encontrado.'], 404);
        }

        try {
            $bloque->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'No se pudo eliminar el bloque porque esta siendo usado.',
            ], 409);
        }

        return response()->json(['message' => 'Bloque eliminado correctamente.']);
    }
}
