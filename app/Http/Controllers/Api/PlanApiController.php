<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanApiController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('plan_entrenamiento')->orderBy('id', 'desc');

        if ($request->filled('id_ciclista')) {
            $query->where('id_ciclista', (int) $request->query('id_ciclista'));
        }

        return response()->json(['data' => $query->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ciclista' => ['required', 'integer', 'exists:ciclista,id'],
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'objetivo' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $validated['activo'] = (int) $request->boolean('activo');

        $id = DB::table('plan_entrenamiento')->insertGetId($validated);
        $plan = DB::table('plan_entrenamiento')->where('id', $id)->first();

        return response()->json(['data' => $plan], 201);
    }

    public function show($id)
    {
        $plan = DB::table('plan_entrenamiento')->where('id', (int) $id)->first();
        if (!$plan) {
            return response()->json(['message' => 'Plan no encontrado.'], 404);
        }

        return response()->json(['data' => $plan]);
    }

    public function update(Request $request, $id)
    {
        $plan = DB::table('plan_entrenamiento')->where('id', (int) $id)->first();
        if (!$plan) {
            return response()->json(['message' => 'Plan no encontrado.'], 404);
        }

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'objetivo' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $validated['activo'] = (int) $request->boolean('activo');

        DB::table('plan_entrenamiento')->where('id', (int) $id)->update($validated);
        $updated = DB::table('plan_entrenamiento')->where('id', (int) $id)->first();

        return response()->json(['data' => $updated]);
    }

    public function destroy($id)
    {
        $plan = DB::table('plan_entrenamiento')->where('id', (int) $id)->first();
        if (!$plan) {
            return response()->json(['message' => 'Plan no encontrado.'], 404);
        }

        try {
            DB::table('plan_entrenamiento')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'No se pudo eliminar el plan de entrenamiento.',
            ], 409);
        }

        return response()->json(['message' => 'Plan eliminado correctamente.']);
    }
}
