<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        return view('plan.index', $this->buildViewData());
    }

    public function edit($id)
    {
        $editPlan = DB::table('plan_entrenamiento')
            ->where('id', (int) $id)
            ->where('id_ciclista', (int) auth()->id())
            ->first();

        if (!$editPlan) {
            abort(404);
        }

        return view('plan.index', array_merge(
            $this->buildViewData(),
            ['editPlan' => $editPlan]
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'objetivo' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $validated['id_ciclista'] = (int) auth()->id();
        $validated['activo'] = (int) $request->boolean('activo');

        DB::table('plan_entrenamiento')->insert($validated);

        return redirect('/plan')->with('status', 'Plan de entrenamiento creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $plan = DB::table('plan_entrenamiento')
            ->where('id', (int) $id)
            ->where('id_ciclista', (int) auth()->id())
            ->first();

        if (!$plan) {
            abort(404);
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

        return redirect('/plan')->with('status', 'Plan de entrenamiento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $plan = DB::table('plan_entrenamiento')
            ->where('id', (int) $id)
            ->where('id_ciclista', (int) auth()->id())
            ->first();

        if (!$plan) {
            abort(404);
        }

        try {
            DB::table('plan_entrenamiento')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return redirect('/plan')->with('error', 'No se pudo eliminar el plan de entrenamiento.');
        }

        return redirect('/plan')->with('status', 'Plan de entrenamiento eliminado correctamente.');
    }

    private function buildViewData()
    {
        $planes = DB::table('plan_entrenamiento')
            ->where('id_ciclista', (int) auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        return ['planes' => $planes];
    }
}
