<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesionController extends Controller
{
    public function index()
    {
        return view('sesion.index', $this->buildViewData());
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

        DB::table('sesion_entrenamiento')->insert($validated);

        return redirect('/sesion')->with('status', 'Sesion de entrenamiento creada correctamente.');
    }

    public function show($id)
    {
        $sesion = DB::table('sesion_entrenamiento')->where('id', (int) $id)->first();
        if (!$sesion) {
            abort(404);
        }

        return response()->json(['data' => $sesion]);
    }

    public function destroy($id)
    {
        try {
            DB::table('sesion_entrenamiento')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return redirect('/sesion')->with('error', 'No se pudo eliminar la sesion de entrenamiento.');
        }

        return redirect('/sesion')->with('status', 'Sesion de entrenamiento eliminada correctamente.');
    }

    private function buildViewData()
    {
        $planes = DB::table('plan_entrenamiento')
            ->select('id', 'nombre', 'fecha_inicio', 'fecha_fin')
            ->orderBy('id', 'desc')
            ->get();

        $sesiones = DB::table('sesion_entrenamiento as se')
            ->join('plan_entrenamiento as pe', 'pe.id', '=', 'se.id_plan')
            ->select(
                'se.id',
                'se.id_plan',
                'se.fecha',
                'se.nombre',
                'se.descripcion',
                'se.completada',
                'pe.nombre as plan_nombre'
            )
            ->orderBy('se.id', 'desc')
            ->get();

        return [
            'planes' => $planes,
            'sesiones' => $sesiones,
        ];
    }
}
