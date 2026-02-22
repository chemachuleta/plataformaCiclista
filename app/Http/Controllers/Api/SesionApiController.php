<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesionApiController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('sesion_entrenamiento as se')
            ->join('plan_entrenamiento as pe', 'pe.id', '=', 'se.id_plan')
            ->select(
                'se.id',
                'se.id_plan',
                'se.fecha',
                'se.nombre',
                'se.descripcion',
                'se.completada',
                'pe.nombre as plan_nombre',
                'pe.id_ciclista'
            )
            ->orderBy('se.id', 'desc');

        if ($request->filled('id_plan')) {
            $query->where('se.id_plan', (int) $request->query('id_plan'));
        }

        if ($request->filled('id_ciclista')) {
            $query->where('pe.id_ciclista', (int) $request->query('id_ciclista'));
        }

        return response()->json(['data' => $query->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_plan' => ['required', 'integer', 'exists:plan_entrenamiento,id'],
            'fecha' => ['required', 'date'],
            'nombre' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'completada' => ['nullable', 'boolean'],
        ]);

        $validated['completada'] = (int) $request->boolean('completada');

        $id = DB::table('sesion_entrenamiento')->insertGetId($validated);
        $sesion = DB::table('sesion_entrenamiento')->where('id', $id)->first();

        return response()->json(['data' => $sesion], 201);
    }

    public function show($id)
    {
        $sesion = DB::table('sesion_entrenamiento as se')
            ->join('plan_entrenamiento as pe', 'pe.id', '=', 'se.id_plan')
            ->select(
                'se.id',
                'se.id_plan',
                'se.fecha',
                'se.nombre',
                'se.descripcion',
                'se.completada',
                'pe.nombre as plan_nombre',
                'pe.id_ciclista'
            )
            ->where('se.id', (int) $id)
            ->first();

        if (!$sesion) {
            return response()->json(['message' => 'Sesion no encontrada.'], 404);
        }

        return response()->json(['data' => $sesion]);
    }

    public function update(Request $request, $id)
    {
        $sesion = DB::table('sesion_entrenamiento')->where('id', (int) $id)->first();
        if (!$sesion) {
            return response()->json(['message' => 'Sesion no encontrada.'], 404);
        }

        $validated = $request->validate([
            'id_plan' => ['required', 'integer', 'exists:plan_entrenamiento,id'],
            'fecha' => ['required', 'date'],
            'nombre' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'completada' => ['nullable', 'boolean'],
        ]);

        $validated['completada'] = (int) $request->boolean('completada');

        DB::table('sesion_entrenamiento')->where('id', (int) $id)->update($validated);
        $updated = DB::table('sesion_entrenamiento')->where('id', (int) $id)->first();

        return response()->json(['data' => $updated]);
    }

    public function destroy($id)
    {
        $sesion = DB::table('sesion_entrenamiento')->where('id', (int) $id)->first();
        if (!$sesion) {
            return response()->json(['message' => 'Sesion no encontrada.'], 404);
        }

        try {
            DB::table('sesion_entrenamiento')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'No se pudo eliminar la sesion de entrenamiento.',
            ], 409);
        }

        return response()->json(['message' => 'Sesion eliminada correctamente.']);
    }
}
